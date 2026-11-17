$ErrorActionPreference = 'Stop'

$projectRoot = (Resolve-Path (Join-Path $PSScriptRoot '..')).Path
$authMode = [Environment]::GetEnvironmentVariable('COGNITA_AUTH_MODE')
if ([string]::IsNullOrWhiteSpace($authMode)) {
  $authMode = 'mock'
  $env:COGNITA_AUTH_MODE = $authMode
}
$authMode = $authMode.ToLowerInvariant()
if ($authMode -notin @('mock', 'backend')) {
  throw 'COGNITA_AUTH_MODE must be either mock or backend.'
}

$defaults = @{
  COGNITA_DB_HOST = '127.0.0.1'
  COGNITA_DB_PORT = '3306'
  COGNITA_DB_NAME = 'cognita_lms'
  COGNITA_DB_USER = 'root'
}

foreach ($name in $defaults.Keys) {
  if ([string]::IsNullOrWhiteSpace([Environment]::GetEnvironmentVariable($name))) {
    Set-Item -Path "Env:$name" -Value $defaults[$name]
  }
}

if ([string]::IsNullOrEmpty([Environment]::GetEnvironmentVariable('COGNITA_DB_PASSWORD'))) {
  $aliasPassword = [Environment]::GetEnvironmentVariable('COGNITA_DB_PASS')
  if ($aliasPassword -ne $null) {
    $env:COGNITA_DB_PASSWORD = $aliasPassword
  }
}

if ([string]::IsNullOrWhiteSpace($env:COGNITA_WEB_PORT)) {
  $env:COGNITA_WEB_PORT = '8002'
}

if (-not (Get-Command php -ErrorAction SilentlyContinue)) {
  throw 'PHP 8.2 was not found on PATH. Add the XAMPP PHP directory or invoke this script from its shell.'
}

$port = 0
if (-not [int]::TryParse($env:COGNITA_WEB_PORT, [ref] $port) -or $port -lt 1 -or $port -gt 65535) {
  throw 'COGNITA_WEB_PORT must be a valid TCP port.'
}

if (Get-NetTCPConnection -State Listen -LocalPort $port -ErrorAction SilentlyContinue) {
  throw "Port $port is already in use. Stop that server or set COGNITA_WEB_PORT to another port."
}

Push-Location $projectRoot
try {
  if ($authMode -eq 'backend') {
    php scripts/check-db.php
    if ($LASTEXITCODE -ne 0) {
      throw 'MySQL preflight failed. Check that MySQL is running and the COGNITA_DB_* variables are correct.'
    }
  }

  php -S "127.0.0.1:$port" -t $projectRoot
}
finally {
  Pop-Location
}
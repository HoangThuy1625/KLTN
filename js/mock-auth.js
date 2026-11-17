(() => {
  const storageKey = 'cognita.mock-auth';

  window.CognitaMockAuth = {
    isEnabled: () => window.CognitaAuthMode === 'mock',
    isAuthenticated: () => window.localStorage.getItem(storageKey) === 'student',
    login: () => window.localStorage.setItem(storageKey, 'student'),
    logout: () => window.localStorage.removeItem(storageKey),
  };
})();

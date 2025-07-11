import React, { createContext, useContext, useState } from 'react';
import * as api from '../services/api';

const AuthContext = createContext();

export const AuthProvider = ({ children }) => {
  const [user, setUser] = useState(null);

  const login = async (email, password) => {
    const loggedInUser = await api.login(email, password);
    setUser(loggedInUser);
  };

  const signup = async (email, password) => {
    const newUser = await api.signup(email, password);
    setUser(newUser);
  };

  const logout = () => {
    setUser(null);
  };

  return (
    <AuthContext.Provider value={{ user, login, signup, logout }}>
      {children}
    </AuthContext.Provider>
  );
};

export const useAuth = () => useContext(AuthContext);

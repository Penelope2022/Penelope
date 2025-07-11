// Simple in-memory fake API that can be replaced with real requests
// If REACT_APP_API_URL is defined, requests will be sent to that URL
// otherwise an in-memory store is used.

let users = [];
const API_URL = process.env.REACT_APP_API_URL;

export const login = async (email, password) => {
  if (API_URL) {
    const res = await fetch(`${API_URL}/login`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ email, password })
    });
    if (!res.ok) {
      throw new Error('Login failed');
    }
    return res.json();
  }
  const user = users.find(u => u.email === email && u.password === password);
  if (!user) {
    throw new Error('Invalid credentials');
  }
  return { email: user.email };
};

export const signup = async (email, password) => {
  if (API_URL) {
    const res = await fetch(`${API_URL}/signup`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ email, password })
    });
    if (!res.ok) {
      throw new Error('Signup failed');
    }
    return res.json();
  }
  const exists = users.some(u => u.email === email);
  if (exists) {
    throw new Error('User already exists');
  }
  const newUser = { email, password };
  users.push(newUser);
  return { email: newUser.email };
};

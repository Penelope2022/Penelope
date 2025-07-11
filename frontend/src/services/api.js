// Simple in-memory fake API that can be replaced with real requests
let users = [];

export const login = async (email, password) => {
  const user = users.find(u => u.email === email && u.password === password);
  if (!user) {
    throw new Error('Invalid credentials');
  }
  return { email: user.email };
};

export const signup = async (email, password) => {
  const exists = users.some(u => u.email === email);
  if (exists) {
    throw new Error('User already exists');
  }
  const newUser = { email, password };
  users.push(newUser);
  return { email: newUser.email };
};

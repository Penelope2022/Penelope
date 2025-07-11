import React from 'react';
import { useAuth } from '../context/AuthContext';
import { useNavigate } from 'react-router-dom';

const AdminDashboard = () => {
  const { user, logout } = useAuth();
  const navigate = useNavigate();

  const handleLogout = () => {
    logout();
    navigate('/login');
  };

  return (
    <div>
      <h2>Painel Administrativo</h2>
      <p>Bem-vindo, {user?.email}</p>
      <button onClick={handleLogout}>Sair</button>
    </div>
  );
};

export default AdminDashboard;

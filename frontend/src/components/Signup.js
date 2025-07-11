import React, { useState } from 'react';
import { useNavigate, Link } from 'react-router-dom';
import { useAuth } from '../context/AuthContext';

const Signup = () => {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [error, setError] = useState(null);
  const navigate = useNavigate();
  const { signup } = useAuth();

  const handleSubmit = async e => {
    e.preventDefault();
    try {
      await signup(email, password);
      navigate('/admin');
    } catch (err) {
      setError(err.message);
    }
  };

  return (
    <div>
      <h2>Cadastro</h2>
      <form onSubmit={handleSubmit}>
        <div>
          <label>Email</label>
          <input value={email} onChange={e => setEmail(e.target.value)} />
        </div>
        <div>
          <label>Senha</label>
          <input type="password" value={password} onChange={e => setPassword(e.target.value)} />
        </div>
        {error && <p style={{ color: 'red' }}>{error}</p>}
        <button type="submit">Registrar</button>
      </form>
      <p>
        Já tem conta? <Link to="/login">Entrar</Link>
      </p>
    </div>
  );
};

export default Signup;

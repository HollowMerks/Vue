import api from './api';

export const notasService = {
  // GET /notas
  getAll() {
    return api.get('/notas');
  },

  // GET /notas/{id}
  getById(id) {
    return api.get(`/notas/${id}`);
  },

  // POST /notas
  create(contenido) {
    return api.post('/notas', { contenido });
  },

  // PUT /notas/{id}
  update(id, contenido) {
    return api.put(`/notas/${id}`, { contenido });
  },

  // DELETE /notas/{id}
  delete(id) {
    return api.delete(`/notas/${id}`);
  },

  // GET /notas/buscar/{patron}
  buscar(patron) {
    return api.get(`/notas/buscar/${patron}`);
  },

  // GET /notas/resumen
  resumen() {
    return api.get('/notas/resumen');
  }
};

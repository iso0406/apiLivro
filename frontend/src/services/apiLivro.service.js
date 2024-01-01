import axios from 'axios'
export default class ApiLivroService {

    static async listBook()
    {
        return axios.get(`listBook`);
    }

    static async listAutor()
    {
        return axios.get(`listAutor`);
    }

    static async listAssunto()
    {
        return axios.get(`listAssunto`);
    }

    static async addLivro(params)
    {
        return axios.post('/create', params);
    }

    static async showLivro(id)
    {
        return axios.get(`/show/${id}`);
    }

    static async atualizarLivro(params, id)
    {
        return axios.put(`/edit/${id}`, params);
    }

    static async deleteLivro(id)
    {
        return axios.put(`/destroy/${id}`);
    }

    static async addAutor(params)
    {
        return axios.post('/createAutor', params);
    }

    static async atualizarAutor(params, id)
    {
        return axios.put(`/editAutor/${id}`, params);
    }

    static async showAutor(id)
    {
        return axios.get(`/showAutor/${id}`);
    }

    static async deleteAutor(id)
    {
        return axios.put(`/destroyAutor/${id}`);
    }

    static async addAssunto(params)
    {
        return axios.post('/createAssunto', params);
    }

    static async atualizarAssunto(params, id)
    {
        return axios.put(`/editAssunto/${id}`, params);
    }

    static async showAssunto(id)
    {
        return axios.get(`/showAssunto/${id}`);
    }

    static async deleteAssunto(id)
    {
        return axios.put(`/destroyAssunto/${id}`);
    }
}
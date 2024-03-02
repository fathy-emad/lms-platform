import axios from "axios";

export async function createMenu(data) {
    const response = await axios.post(`${import.meta.env.VITE_API_URL}/admin/setting/route-menu`, data, {headers: {
        Authorization: `Bearer ${localStorage.token}` 
    }})
    return response.data;
}
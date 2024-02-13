import axios from "axios"

export const  getTeachers = async () => {
   const data = axios.get(import.meta.env.VITE_API_URL + "/admin/teacher/register", {
    headers: "Bearer " + localStorage.token
   });
   return {data: data.data}
}
import axios from "axios"

export const  getEmployees = async () => {
   const data = await axios.get(import.meta.env.VITE_API_URL + "/admin/employee/register", {
    headers: {
        Authorization: "Bearer " + localStorage.token
    }
   });
   if(data.data.statusCode == 200) {
       return data.data.data
   }
   return 0;
}
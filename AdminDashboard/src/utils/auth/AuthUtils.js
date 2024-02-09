import axios from "axios"


export const isAuthenticated = () => {
   if(localStorage.getItem("isLoggedIn") == "true") {
      return {message: true};
   } else {
      return {message: false};
   }
}

export const authenticateUser = async (userEmail, userPass) => {
   const response = await axios.post(import.meta.env.VITE_API_URL + "/admin/auth/login", {email: userEmail,password: userPass});
   if(response.data.statusCode == 200) {
      localStorage.setItem("token", response.data.data.jwtToken);
      localStorage.setItem("isLoggedIn", true);
      return {message: true, data: response.data};
  }
   return {message: false , data: response.data.errors};
}

//logout
export const unAuthenticateUser = async () => {

  const data = await axios.post(import.meta.env.VITE_API_URL + "/admin/auth/logout", {}, {headers: {
      Authorization: "Bearer " + localStorage.getItem("token")
   }});
   if(data.data.success == true) {
      localStorage.removeItem("token");
      localStorage.removeItem("isLoggedIn");
      return {message: true}
   } else {
      return {message: false}
   }
}

export const getUserData = () => {

}
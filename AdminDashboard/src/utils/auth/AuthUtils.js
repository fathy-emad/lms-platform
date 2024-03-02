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
export const changePassword = async (currentPass, newPass, confirmPass) => {
   const data = await axios.post(import.meta.env.VITE_API_URL + "/admin/auth/change-password", {currentPassword: currentPass, password: newPass, password_confirmation: confirmPass}, {headers: {Authorization: 'Bearer ' + localStorage.token}});
   if(data.data.success == true) {
      return true;
   } else {
      return false;
   }
}

export const sendForgetPasswordRequest = async (email) => {
  const res = await axios.post(import.meta.env.VITE_API_URL + "/admin/auth/reset-password", {email: email}, {headers: {
      Authorization: 'Bearer ' + localStorage.token
   }})
   const data = {message: res.data.message, success: res.data.statusCode};
    return data
   
}
export const sendVerificationToken = async (token, email) => {
   const res = await axios.post(import.meta.env.VITE_API_URL + "/admin/auth/verify-token", {email: email, verifyToken: token})
   const data = {message: res.data.message, success: res.data.statusCode, errors: res.errors, data: res.data.data};
   return data;
}
export const changeForgotenPassword = async (email, token, password, newPassword) => {
   const res = await axios.post(import.meta.env.VITE_API_URL + "/admin/auth/new-password", {email: email, verifyToken: token, password: password, password_confirmation: newPassword});
   if(res.data.statusCode == "200") {
      localStorage.setItem("token", res.data.data.jwtToken);
      localStorage.setItem("isLoggedIn", true);
   }
   const data = {message: res.data.message, success: res.data.statusCode, errors: res.data.errors};
   return data;
}
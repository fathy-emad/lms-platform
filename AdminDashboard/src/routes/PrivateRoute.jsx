import { Navigate, Route } from "react-router-dom"
import { isAuthenticated } from "../utils/auth/AuthUtils";
import Dashboard from "../pages/Dashboard";
const PrivateRoute = () => {
    let isAuth = isAuthenticated();
    return isAuth.message ? <Dashboard /> : <Navigate to="/login" /> 
}
export default PrivateRoute;
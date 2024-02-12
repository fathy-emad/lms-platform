import { Navigate, Route, Routes } from "react-router-dom"
import Employees from "../pages/Employees";
import Teachers from "../pages/Teachers";
import CreateTeacher from "../pages/CreateTeacher";
import Courses from "../pages/Courses";
import NotFound from "../pages/NotFound404";
import Login from "../pages/auth/login";
import DashboardContent from "../pages/DashboardContent";
import PrivateRoute from "./PrivateRoute";
import { isAuthenticated } from "../utils/auth/AuthUtils";
import Logout from "../pages/auth/logout";
import ChangePassword from "../pages/ChangePassword";
import ForgetPass from "../pages/auth/forget";
import NewPasswordForgoten from "../pages/newPassword";
const AppRoutes = () => {
    return (
      <Routes>
        <Route path="/" element={<PrivateRoute />}>
            <Route index element={<DashboardContent />} />
            <Route exact path="employees" element={<Employees />} />
            <Route  path="teachers">
              <Route index element={<Teachers />}></Route>
              <Route path="create" element={<CreateTeacher />}></Route>
            </Route>
            <Route  path="settings">
              <Route path="change-password" element={<ChangePassword />}></Route>
            </Route>
            <Route exact path="courses" element={<Courses />} />
            <Route path="*" element={<NotFound />} />
            <Route exact path="/logout" element={<Logout />}  />
        </Route>
        <Route exact path="/login" element={isAuthenticated().message ? <Navigate to="/" /> : <Login />} />   
        <Route exact path="/forget-password" element={isAuthenticated().message ? <Navigate to="/" /> : <ForgetPass />} /> 
        <Route exact path="/new-password" element={isAuthenticated().message ? <Navigate to="/" /> : <NewPasswordForgoten />} /> 
      </Routes>
    )
}

export default AppRoutes;
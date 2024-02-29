import { useNavigate } from "react-router-dom";
import { unAuthenticateUser } from "../../utils/auth/AuthUtils";
const Logout = () => {
    const navigate = useNavigate();
    unAuthenticateUser().then(data => {
        if(data.message == true) {
            return navigate("/login");
        }
    });
}
export default Logout;
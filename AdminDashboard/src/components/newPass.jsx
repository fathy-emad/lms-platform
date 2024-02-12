import { useContext, useState } from "react";
import { changeForgotenPassword } from "../utils/auth/AuthUtils";
import { forgetContext } from "../pages/auth/forget";
import { useNavigate } from "react-router-dom";
const NewPassword = () => {
    const forgetData = useContext(forgetContext);
    const navigate = useNavigate();
    const [errors, setErrors] = useState(false);

    const handleSubmit = async (e) => {
        e.preventDefault();
        let newPass = e.target[0].value;
        let confirmPass = e.target[1].value;
        let data =  await changeForgotenPassword(forgetData.emailAddress, sessionStorage.newPasswordToken,newPass, confirmPass);
        
        forgetData.setRequestCode(data.success)
        forgetData.setSendingCode(false)
        if(data.success == "200") {
            forgetData.setRequestMessage(data.message + " please wait 3 seconds to be navigated to home page");
            sessionStorage.removeItem("newPasswordToken")
            setTimeout(() => {
                navigate("/")
            }, 3000)
        } else {
            setErrors(data.errors.password);
        }

    }
    return (
        <form onSubmit={handleSubmit} className="space-y-4 md:space-y-6" action="#">
        <div>
            <label htmlFor="newPassword" className="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New Password</label>
            <input type="password" name="newPassword" id="email" className="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="your new password" required="" />
        </div>
        <div>
            <label htmlFor="password" className="block mb-2 text-sm font-medium text-gray-900 dark:text-white">confirm new password</label>
            <input type="password" name="confirmPassword" id="password" placeholder="confirm password" className="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="" />
          
        </div>
        <div className="flex flex-col gap-1">
            {errors ? errors.map((error) => {
                return <p className=" m-0 text-red-700">{error}</p>
            }) : ""}
        </div>
                <button type="submit" className="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Change password</button>

    </form>
    )
}

export default NewPassword;
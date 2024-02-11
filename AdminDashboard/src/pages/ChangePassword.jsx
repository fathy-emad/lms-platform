import { changePassword } from "../utils/auth/AuthUtils";

const ChangePassword = () => {
    function handleSubmit(e) {
        
        e.preventDefault();
        const response = changePassword(e.target[0].value, e.target[1].value, e.target[2].value);
        console.log(response);
    }
    return (
        <div className="flex flex-col justify-center items-center gap-2">
            <h3 className="text-3xl font-bold">Change Your Password</h3>
            <form onSubmit={handleSubmit} className="flex flex-col even:py-3 gap-2" action="">
                <label htmlFor="currentPassword">Current Password</label>
                <input type="text" className=" form-input" name="currentPassword"  />
                <label htmlFor="password">New Password</label>
                <input type="text" className=" form-input" name="password"  />
                <label htmlFor="password_confirmation">Confirm Password</label>
                <input type="text" className=" form-input" name="password_confirmation"  />
                <ul className="text-red-600">
                    <li>The password field must contain at least one uppercase and one lowercase letter.</li>
                    <li>The password field must contain at least one letter.</li>
                    <li>The password field must contain at least one symbol.</li>
                </ul>
                <button className="bg-green-600 text-white p-3  rounded-md" type="submit">Change Password</button>
            </form>
        </div>
    )
}

export default ChangePassword;
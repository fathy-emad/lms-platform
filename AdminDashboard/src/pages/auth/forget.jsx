import { createContext, useState } from "react";
import { sendForgetPasswordRequest } from "../../utils/auth/AuthUtils";
import ForgetPassForm from "../../components/forgetPassForm";
import ForgetTokenForm from "../../components/forgetTokenForm";
import NewPassword from "../../components/newPass";
export const forgetContext = createContext();
const ForgetPass = () => {
    const [requestMessage, setRequestMessage] = useState();
    const [requestCode, setRequestCode] = useState();
    const [sendingCode, setSendingCode] = useState(false);
    const [emailAddress, setEmail] = useState(false);
    const [changePasswordState, setPassState] = useState(false);
    const [verificationSent, setVerificationSent] = useState(0);
    return (
        <forgetContext.Provider value={{requestCode, setRequestCode, requestMessage, setRequestMessage, sendingCode, setSendingCode, setVerificationSent, setEmail, emailAddress, changePasswordState, setPassState}}>
        <section className="bg-gray-50 dark:bg-gray-900">
  <div className="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">

      <div className="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
          <div className="p-6 space-y-4 md:space-y-6 sm:p-8">
              <h1 className="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                  {!verificationSent ? "Write your email to send verification code" : "Write your verification code"}
              </h1>
            {verificationSent == 0 ? <ForgetPassForm /> : ""}
            {verificationSent == 1 ? <ForgetTokenForm /> : ""}
            {verificationSent == 2 ? <NewPassword /> : ""}
          </div>
      </div>
  </div>
</section>
</forgetContext.Provider>

    )
}

export default ForgetPass;
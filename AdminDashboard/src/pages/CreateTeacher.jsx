const CreateTeacher = () => {
    return (
        <div className="flex w-full h-full justify-center items-center">
            <form className="grid grid-cols-2 grid-rows-4 gap-5">
                <div>
                    <label className="block" htmlFor="name">name</label>
                    <input name="name" className=" w-full form-input" type="text" />
                </div>
                <div>
                    <label className="block" htmlFor="phone">phone number</label>
                    <input name="phone" className=" w-full form-input" type="text" />
                </div>
                <div className="col-span-2">
                    <label className="block" htmlFor="email">email</label>
                    <input name="email" className=" form-input w-full" type="email" />
                </div>
                <div>
                    <label className="block" htmlFor="password">password</label>
                    <input name="password" className=" form-input w-full" type="password" />
                </div>
                <div>
                    <label className="block" htmlFor="email">confirm password</label>
                    <input name="confirm_password" className=" form-input w-full" type="password" />
                </div>
                <select name="GenderEnum" className="form-input">
                    <option value="male">male</option>
                    <option value="female">female</option>
                </select>
                <select name="TeacherStatusEnum" className="form-input">
                    <option value="active">active</option>
                    <option value="pending">pending</option>
                    <option value="blocked">blocked</option>
                </select>
                <div>
                    <label className="block" htmlFor="image">Teacher image</label>
                    <input type="file" name="image" className="form-input" id="" />
                </div>
                <div>
                    <label className="block" htmlFor="contract">Contract</label>
                    <input type="file" name="contract" className="form-input" />
                </div>
                <button className=" bg-green-600 text-white p-5 col-span-2 rounded-md" type="submit">Create Teacher</button>
            </form>
        </div>
    )
}

export default CreateTeacher;
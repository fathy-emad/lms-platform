import { useEffect } from "react";
import { useForm } from "react-hook-form"
import { createMenu } from "../utils/menu/MenuUtils";

const CreateRouteMenu = () => {
    const {register, handleSubmit, formState:{errors}} = useForm();

    return (
        <div>
            <h3 className="text-3xl text-center py-4">Create a new menu</h3>
            <form onSubmit={handleSubmit((data) => createMenu(data))} className="flex flex-col gap-3 justify-center items-center">
                <input className="rounded" placeholder="title" type="text" {...register("title", {required: "please make sure to write a title"})} />
                {errors.title && <p className=" text-red-600">{errors.title.message}</p>}
                <input className="rounded" placeholder="route" type="text" {...register("route", {required: "please make sure to write a route"})} />
                {errors.route ? <p className=" text-red-600">{errors.route.message}</p> : ""}

                <select {...register("ActiveEnum", {required: true})}>
                    <option value="active">active</option>
                    <option value="not-active">non active</option>
                </select>
                <button className=" bg-green-600 text-white px-4 py-2 rounded">Create</button>
            </form>
        </div>
    )
}
export default CreateRouteMenu;
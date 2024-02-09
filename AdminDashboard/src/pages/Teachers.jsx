import { useEffect, useState } from "react";
import MainDataTable from "../components/MainDataTable";
import axios from "axios";

const Teachers = () => {
  const [data, setData] = useState(null);
  useEffect(() => {
    axios.get(import.meta.env.VITE_API_URL)
  }, [data])
    return (
        <div>
            <MainDataTable data={data} />
        </div>
    )
}
export default Teachers;
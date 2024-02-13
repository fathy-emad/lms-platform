import { useEffect, useState } from "react";
import MainDataTable from "../components/EmployeesTable";
import axios from "axios";
import { getTeachers } from "../utils/teachers/TeachersUtils";
const Teachers = () => {

  const [data, setData] = useState(null);
  const teachers = async () => {
    const TeachersLoad = await getTeachers();
    setData(TeachersLoad)
  }
  useEffect(() => {
    if(!data) {
      teachers()
    }
  })
    return (
        <div>
            {/* <MainDataTable data={data} /> */}
        </div>
    )
}
export default Teachers;
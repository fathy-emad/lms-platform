import { useEffect, useState } from "react";
import EmployeesTable from "../components/EmployeesTable";
import { getEmployees } from "../utils/employees/EmployeesUtils";
const Employees = () => {
    const [data, setData] = useState(null);
    const employees = async () => {
      const EmployeesLoad = await getEmployees();
      if(EmployeesLoad) {
          setData(EmployeesLoad)
      }
      console.log(EmployeesLoad)
    }
    useEffect(() => {
        if(!data) {
            employees()
        }
    })

    return (
        <div>
            {data ? <EmployeesTable data={data}></EmployeesTable> : "no data found"}
        </div>
    )
}
export default Employees;
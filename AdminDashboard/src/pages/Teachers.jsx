import { useEffect, useState } from "react";
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
        </div>
    )
}
export default Teachers;
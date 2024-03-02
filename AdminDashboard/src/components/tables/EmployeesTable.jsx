import DataTable from 'react-data-table-component';

const columns = [
	{
		name: '#',
		selector: row => row.id,
        sortable: true,
	},
	{
		name: 'Name',
		selector: row => row.name,
        sortable: true,
	},
	{
		name: 'Email',
		selector: row => row.email,
        sortable: true,
	},
	{
		name: 'Phone',
		selector: row => row.phone,
	},
	{
		name: 'National id',
		selector: row => row.national_id,
	},
	{
		name: 'Gender',
		selector: row => row.GenderEnum.key,
	},
	{
		name: 'Role',
		selector: row => row.AdminRoleEnum.key,
	},
	{
		name: 'Role',
		selector: row => row.AdminRoleEnum.key,
	},
	{
		name: 'Status',
		selector: row => row.AdminStatusEnum.key,
	},
];

function EmployeesTable(props) {
	return (
		<DataTable
			columns={columns}
			data={props.data}
            sortable={true}
            pagination
		/>
	);
};
export default EmployeesTable;
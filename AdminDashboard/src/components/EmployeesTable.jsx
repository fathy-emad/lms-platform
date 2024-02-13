import DataTable from 'react-data-table-component';

const columns = [
	{
		name: 'id',
		selector: row => row.id
	},
	{
		name: 'name',
		selector: row => row.name,
		sortable: true,
	},
	{
		name: 'phone',
		selector: row => row.phone,
		sortable: true,
	},
	{
		name: 'email',
		selector: row => row.email,
		sortable: true
	},
	{
		name: 'national id',
		selector: row => row.national_id,
		
	},
	{
		name: "type",
		selector: row => row.AdminRoleEnum.key,
		sortable: true
	},
	{
		name: "gender",
		selector: row => row.GenderEnum.key,
		sortable: true
	},
	{
		name: "country",
		selector: row => row.country,
		sortable: true
	},
	{
		name: "created at",
		sortable: true,
		selector: row => row.created_at.timestamp
	},

];

// const data = [
// 	{
// 		"id": 1,
// 		"name": "Fathy emad",
// 		"email": "fatyemad@gmail.com",
// 		"phone": "1141661776",
// 		"national_id": "29412012109216",
// 		"country": "Egypt",
// 		"AdminRoleEnum": {
// 			"key": "admin",
// 			"translate": "أدمن"
// 		},
// 		"AdminStatusEnum": {
// 			"key": "active",
// 			"translate": "نشط"
// 		},
// 		"GenderEnum": {
// 			"key": "male",
// 			"translate": "ذكر"
// 		},
// 		"block_reason": null,
// 		"online": false,
// 		"image": null,
// 		"address": null,
// 		"email_verified_at": null,
// 		"created_by": null,
// 		"updated_by": null,
// 		"created_at": {
// 			"timestamp": "2024-02-07T00:39:00.000000Z",
// 			"dateTime": "07/2/2024 2:39 AM"
// 		},
// 		"updated_at": {
// 			"timestamp": "2024-02-07T01:17:27.000000Z",
// 			"dateTime": "07/2/2024 3:17 AM"
// 		}
// 	}
// ]

function EmployeesTable(props) {
	return (
		<DataTable
			columns={columns}
			data={props.data}
		/>
	);
};

export default EmployeesTable;
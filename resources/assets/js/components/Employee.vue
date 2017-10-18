<template>
    <div>
    <v-btn fab dark color="green" @click.stop="createDialog">
        <v-icon dark>add</v-icon>
    </v-btn>
    <employee-dialog @cancel="closeDialog" @save-employee="saveEmployee" @edit-employee="updateEmployee" :dialog="dialog" :employee="employee" :editing="editing" :draft="draft"></employee-dialog>
    <v-card>
        <v-card-title>
            Employees
            <v-spacer></v-spacer>
            <v-text-field
                append-icon="search"
                label="Search"
                single-line
                hide-details
                v-model="search"
            ></v-text-field>
        </v-card-title>
        <v-data-table
            v-bind:headers="headers"
            v-bind:items="items"
            v-bind:pagination.sync="pagination"
            v-bind:search="search"
            item-key="id"
            class="elevation-1"
        >
        <template slot="items" scope="props">
            <td>{{ props.item.id }}</td>
            <td class="text-xs-right">{{ props.item.name }}</td>
            <td class="text-xs-right">{{ props.item.lastname }}</td>
            <td class="text-xs-right">{{ props.item.birthday }}</td>
            <td class="text-xs-right">{{ props.item.email }}</td>
            <td class="text-xs-right">{{ props.item.ci }}</td>
            <td class="text-xs-right">{{ props.item.phone }}</td>
            <td class="text-xs-right">{{ props.item.address }}</td>
            <td class="text-xs-right">
                <v-btn icon @click.native="editDialog(props.item)">
                    <v-icon>edit</v-icon>
                </v-btn>
                <v-btn icon @click.native="deleteEmployee(props.item)">
                    <v-icon>delete</v-icon>
                </v-btn>
            </td>
        </template>
        </v-data-table>
        <v-layout row justify-center>
            <v-btn color="primary" dark @click.native.stop="dialog1 = true">Open Dialog</v-btn>

            <v-dialog v-model="dialog1">
                <v-card>
                    <v-card-title class="headline">Delete Employee</v-card-title>
                    <v-card-text>Are you sure you want to delete the employee?</v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="green darken-1" flat="flat" @click.native="dialog1 = false">Delete</v-btn>
                        <v-btn color="green darken-1" flat="flat" @click.native="dialog1 = false">Cancel</v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </v-layout>
    </v-card>
    </div>
</template>

<script>
export default {

    data: () => ({
        dialog: false,
        dialog1: false,
        employee: {},
        draft: {},
        editing: false,
        pagination: {
            sortBy: 'id'
        },
        search: '',
        headers: [
            {
                text: 'Id',
                align: 'left',
                sortable: false,
                value: 'id'
            },
            { text: 'Name', value: 'name' },
            { text: 'Last Name', value: 'lastname' },
            { text: 'Birthday', value: 'birthday' },
            { text: 'Email', value: 'email' },
            { text: 'CI', value: 'ci' },
            { text: 'Phone', value: 'phone' },
            { text: 'Address', value: 'address' }
        ],
        items: []
    }),

    mounted() {
        this.fetchEmployees()
    },

    methods: {
        fetchEmployees() {
            axios.get('api/employees')
            .then( response => {
                this.items = response.data
            })
        },

        closeDialog(editing, employee, draft) {
            if (editing) {
                let item = _.find(this.items, function(item) { return item.id == draft.id })
                let index = this.items.indexOf(item)
                _.isEmpty(draft) ? this.items.splice(index, 1) : this.items.splice(index, 1, draft)
            }
            this.dialog = false
        },

        saveEmployee(employee) {
            axios.post('api/employees', employee)
            .then( response => {
                this.employee = response.data
                this.fetchEmployees()
            }).catch( error => {

            })
            this.closeDialog()
        },

        updateEmployee(employee) {
            axios.put('api/employees/'+employee.id, employee)
            .then( response => {
                this.employee = response.data
            }).catch( error => {

            })
            this.closeDialog()
        },

        deleteEmployee(employee) {
            axios.delete('api/employees/'+employee.id)
            .then( response => {
                let index = this.items.indexOf(employee)
                this.items.splice(index, 1)
            })
        },

        createDialog() {
            this.dialog = true
            this.editing = false
            this.employee = {}
        },

        editDialog(employee) {
            this.dialog = true
            this.editing = true
            this.employee = employee
            this.draft = JSON.parse(JSON.stringify(this.employee))
        },

    }
};
</script>

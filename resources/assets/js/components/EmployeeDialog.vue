<template>
    <v-dialog v-model="dialog" fullscreen transition="dialog-bottom-transition" :overlay=false scrollable>
        <v-card>
            <v-toolbar style="flex: 0 0 auto;" dark class="primary">
                <v-btn icon @click.native="onCancel" dark>
                    <v-icon>close</v-icon>
                </v-btn>
                <v-toolbar-title v-if="!editing">Add New Employee</v-toolbar-title>
                <v-toolbar-title v-if="editing">Edit Employee</v-toolbar-title>
                <v-spacer></v-spacer>
                <v-toolbar-items>
                    <v-btn v-if="editing" dark flat @click.native="onEdit">Edit</v-btn>
                    <v-btn v-if="!editing" dark flat @click.native="onSave">Save</v-btn>
                    <v-btn dark flat @click.native="onCancel">Cancel</v-btn>
                </v-toolbar-items>
            </v-toolbar>
            <v-card-text>
                <v-form>
                    <v-text-field
                        label="Name"
                        v-model="employee.name"
                        required
                    ></v-text-field>
                    <v-text-field
                        label="Last Name"
                        v-model="employee.lastname"
                        required
                    ></v-text-field>
                    <v-flex xs12>
                        <v-menu
                            lazy
                            :close-on-content-click="true"
                            v-model="menu"
                            transition="scale-transition"
                            offset-y
                            full-width
                            :nudge-right="40"
                            max-width="290px"
                            min-width="290px"
                        >
                            <v-text-field
                              slot="activator"
                              label="Birthday"
                              v-model="employee.birthday"
                              prepend-icon="event"
                              readonly
                            ></v-text-field>
                            <v-date-picker v-model="employee.birthday" no-title scrollable actions>
                            </v-date-picker>
                        </v-menu>
                    </v-flex>
                    <v-text-field
                        label="E-mail"
                        v-model="employee.email"
                        required
                    ></v-text-field>
                    <v-text-field
                        label="CI"
                        v-model="employee.ci"
                        required
                    ></v-text-field>
                    <v-text-field
                        label="Phone"
                        v-model="employee.phone"
                        required
                    ></v-text-field>
                    <v-text-field
                        label="Address"
                        v-model="employee.address"
                        required
                    ></v-text-field>
                </v-form>
            </v-card-text>
        </v-card>
    </v-dialog>
</template>

<script>
export default {
    props: ['dialog', 'employee', 'editing', 'draft'],

    data: () => ({
        menu: false
    }),

    methods: {
        onSave() {
            this.$emit('save-employee', this.employee)
        },

        onEdit() {
            this.$emit('edit-employee', this.employee)
        },

        onCancel() {
            this.$emit('cancel', this.editing, this.employee, this.draft)
        }
    }
};
</script>

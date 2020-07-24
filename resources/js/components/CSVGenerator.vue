<template>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">Table to CSV Generator</div>

                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th v-for="(column, index) in columns" :key="index">
                                        <input type="text"
                                            class="form-control font-weight-bold"
                                            :value="column.key"
                                            @input="update_column_key(column, $event)"
                                        >
                                    </th>
                                    <th>
                                        <button class="btn btn-outline-primary add_column_btn" @click="add_column">
                                            <i class="fas fa-plus"></i>
                                            Add column
                                        </button>
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr v-for="(row, row_index) in rows" :key="row_index">
                                    <td v-for="(column, col_index) in columns" :key="col_index">
                                        <input type="text" class="form-control" v-model="rows[row_index][column.key]">
                                    </td>
                                    <td>
                                        <button class="btn btn-outline-danger remove_row_btn" @click="remove_row(index)">
                                            <i class="far fa-trash-alt"></i>
                                            Remove row
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <button type="button" class="btn btn-secondary add_row_btn" @click="add_row">
                            <i class="fas fa-plus"></i>
                            Add Row
                        </button>
                    </div>

                    <div class="card-footer text-right">
                        <button class="btn btn-outline-secondary reset_btn" type="button" @click="reset" v-if="data_has_changed()">
                            <i class="fas fa-history"></i>
                            reset
                        </button>

                        <button class="btn btn-primary export_btn" type="button" @click="submit">
                            <i class="fas fa-file-download"></i>
                            Export
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>

    import * as fn from '../_helpers.js';

    export default {
        name: 'CSVGenerator',

        data() {
            return {
                rows: [
                    {
                        first_name: 'John',
                        last_name: 'Doe',
                        email_address: 'john.doe@example.com',
                    },{
                        first_name: 'John',
                        last_name: 'Doe',
                        email_address: 'john.doe@example.com',
                    },
                ],

                col_id: 0,
                columns: [
                    {key: 'first_name'},
                    {key: 'last_name'},
                    {key: 'email_address'},
                ],

                original_data: [],
                original_columns: [],
            };
        },



        mounted() {

            // make a copy of the original data incase the user wants to reset back to this
            this.original_data = fn.shallow_copy_object(this.rows);
            this.original_columns = fn.shallow_copy_object(this.columns);
        },



        computed: {

            column_keys() {
                return this.columns.map(c => c.key);
            }
        },



        methods: {

            /**
             * @description Add new empty row to the table, matching original data
             */
            add_row() {
                this.rows.push({
                    first_name: '',
                    last_name: '',
                    email_address: '',
                });
            },




            /**
             * @description Remove the given row from the table
             *
             * @param {int} row_index
             */
            remove_row(row_index) {
                this.rows.splice(row_index, 1);
            },




            /**
             * @description add a new column to the table
             */
            add_column() {

                // first add the new column to the "columns" data object
                this.columns.push({
                    key: 'new_column_' + this.col_id
                });

                // now add the new column to each row
                this.rows.forEach(
                    (row) => {
                        row['new_column_' + this.col_id] = '';
                    }
                );

                // increment col_id so if we add multiple columns there's no conflict
                this.col_id++;
            },




            /**
             * @description - update the column key when changing the name
             *
             * @param {object} column
             * @param {object} event
             */
            update_column_key(column, event) {

                let oldKey = column.key;

                let columnKeyExists = !!this.columns.find(column => column.key === event.target.value);

                column.key = event.target.value;

                // prevent duplicate column names, append an underscore to the key
                if (columnKeyExists) {
                    column.key = event.target.value + '_';
                    return;
                }

                this.rows.forEach(
                    (row) => {
                        row[column.key] = row[oldKey];
                        delete row[oldKey];
                    }
                )
            },




            /**
             * @description - basic check to see if the original data has changed
             *
             * @returns {bool}
             */
            data_has_changed() {

                if (JSON.stringify(this.rows) == JSON.stringify(this.original_data)
                    && JSON.stringify(this.columns) == JSON.stringify(this.original_columns)
                ) {
                    return false;
                } else {
                    return true;
                }
            },




            /**
             * @description - reset all data to original values
             */
            reset() {
                this.rows = fn.shallow_copy_object(this.original_data);
                this.columns = fn.shallow_copy_object(this.original_columns);
                this.col_id = 0;
            },




            /**
             * @description - submit the form
             */
            submit() {

                let data = {
                    'columns': this.column_keys,
                    'rows': this.rows,
                };

                // Handy snippet for forcing file download from an ajax response
                // https://gist.github.com/javilobo8/097c30a233786be52070986d8cdb1743

                axios({
                    url: '/api/csv-export',
                    method: 'POST',
                    data,
                    responseType: 'blob',
                }).then((response) => {

                    this.download_data_as_csv(response.data);
                }).catch(function (error) {
                    console.log(error);
                });
            },




            /**
             * @description - generate a csv file download from the data
             *
             * @param {object} data
             */
            download_data_as_csv(data) {

                const url = window.URL.createObjectURL(new Blob([data]));
                const link = document.createElement('a');

                link.href = url;
                link.setAttribute('download', 'csv-export.csv');
                document.body.appendChild(link);
                link.click();
            }
        },
    }
</script>

<style scoped>

    .btn_icon_light {
        filter: invert(100%) sepia(100%) saturate(2%) hue-rotate(223deg) brightness(106%) contrast(100%);
    }

    .btn_icon {
        width: 20px;
        position: relative;
        top: -2px;
    }

</style>

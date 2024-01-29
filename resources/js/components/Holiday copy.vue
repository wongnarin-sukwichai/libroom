<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="flex card-header">
                        <box-icon
                            name="dots-vertical-rounded"
                            size="md"
                            class="pr-2"
                        ></box-icon>
                        <box-icon
                            name="time"
                            color="gray"
                            size="md"
                            class="pr-2"
                        ></box-icon>
                        <span class="text-xl py-1">เวลาให้บริการ</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Button -->
        <div class="flex justify-end">
            <button
                class="bg-green-300 hover:bg-green-400 shadow-lg rounded-md p-2 text-sm text-gray-700"
                @click="showModal()"
            >
                เพิ่มข้อมูล
            </button>
        </div>

        <!-- Table -->
        <div class="overflow-auto mt-4">
            <table class="border-collapse border w-full">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="p-2 w-48">วันที่</th>
                        <th class="border p-2">รายละเอียด</th>
                        <th class="border p-2 w-72">แก้ไขล่าสุด</th>
                        <th class="border p-2 w-56">#</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        class="border bg-sky-50"
                        v-for="(month, index) in monthList"
                        :key="index"
                    >
                        <td class="p-2 col-span-3 text-lg">
                            {{ month.title }}
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr
                        class="text-center"
                        v-for="(holiday, index) in holidayList"
                        :key="index"
                    >
                        <td class="border p-2">{{ holiday.d }}</td>
                        <td class="border p-2">{{ holiday.detail }}</td>
                        <td>{{ holiday.created }}</td>
                        <td class="border p-2">
                            <div class="flex justify-center">
                                <div>
                                    <box-icon
                                        name="cog"
                                        color="#94a3b8"
                                        size="sm"
                                        animation="tada-hover"
                                        class="cursor-pointer"
                                    ></box-icon>
                                </div>
                                <div class="pl-2">
                                    <box-icon
                                        name="trash"
                                        color="#f87171"
                                        size="sm"
                                        animation="tada-hover"
                                        class="cursor-pointer"
                                        @click="del(holiday.id, index)"
                                    ></box-icon>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Show -->
    <transition name="fade" mode="out-in">
        <div
            class="relative z-10"
            aria-labelledby="modal-title"
            role="dialog"
            aria-modal="true"
            v-show="isModalShow"
        >
            <div
                class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
            ></div>

            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div
                    class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0"
                >
                    <form
                        class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg"
                        @submit.prevent="send()"
                    >
                        <div
                            class="grid grid-cols-2 bg-white px-4 pb-4 sm:p-4 sm:pb-4 mt-4"
                        >
                            <div class="sm:flex sm:items-start">
                                <div
                                    class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10"
                                >
                                    <box-icon name="calendar"></box-icon>
                                </div>
                                <div
                                    class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full"
                                >
                                    <label
                                        id="listbox-label"
                                        class="block text-sm font-medium leading-6 text-gray-900"
                                        >วันที่ :
                                    </label>
                                    <select
                                        class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        required
                                        v-model="data.d"
                                    >
                                        <option disabled value="" selected>
                                            กรุณาเลือก...
                                        </option>
                                        <option
                                            v-for="n in 31"
                                            :key="n"
                                            :value="n"
                                        >
                                            {{ n }}
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="sm:flex sm:items-start">
                                <div
                                    class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full"
                                >
                                    <label
                                        id="listbox-label"
                                        class="block text-sm font-medium leading-6 text-gray-900"
                                        >เดือน :
                                    </label>
                                    <select
                                        class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        required
                                        v-model="data.m"
                                    >
                                        <option disabled value="" selected>
                                            กรุณาเลือก...
                                        </option>
                                        <option
                                            v-for="(month, index) in monthList"
                                            :key="index"
                                            :value="month.id"
                                        >
                                            {{ month.title }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white px-4 pt-5 sm:p-4 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div
                                    class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10"
                                >
                                    <box-icon
                                        name="message-rounded-dots"
                                    ></box-icon>
                                </div>
                                <div
                                    class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full"
                                >
                                    <label
                                        id="listbox-label"
                                        class="block text-sm font-medium leading-6 text-gray-900"
                                    >
                                        รายละเอียด :</label
                                    >
                                    <textarea
                                        class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                        id="detail"
                                        required
                                        v-model="data.detail"
                                    ></textarea>
                                </div>
                            </div>
                        </div>

                        <div
                            class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6"
                        >
                            <button
                                type="submit"
                                class="inline-flex w-full justify-center rounded-md bg-green-500 px-3 py-2 text-sm text-white shadow-sm hover:bg-green-600 sm:ml-3 sm:w-auto"
                            >
                                บันทึก
                            </button>
                            <button
                                type="button"
                                class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm text-gray-900 shadow-sm hover:bg-gray-50 ring-1 ring-inset ring-gray-300 sm:mt-0 sm:w-auto"
                                @click="close()"
                            >
                                ออก
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
import "boxicons";
import Swal from "sweetalert2";

export default {
    mounted() {
        this.getMonth();
        this.getHoliday();
    },
    data() {
        return {
            isModalShow: false,
            monthList: "",
            holidayList: "",
            data: {
                d: "",
                m: "",
                detail: "",
            },
        };
    },
    methods: {
        showModal() {
            this.isModalShow = true;
        },
        close() {
            this.isModalShow = false;
        },
        getMonth() {
            axios
                .get("/api/month")
                .then((response) => {
                    this.monthList = response.data;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        getHoliday() {
            axios
                .get("/api/holiday")
                .then((response) => {
                    this.holidayList = response.data;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        async send() {
            try {
                await this.$store.dispatch("storeHoliday", this.data);
                await Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "บันทึกข้อมูลเรียบร้อย",
                    showConfirmButton: false,
                    timer: 1500,
                });
                this.isModalShow = false;
                this.getHoliday();
            } catch (err) {
                console.log(err);
            }
        },
        del(id, index) {
            Swal.fire({
                title: "ต้องการลบข้อมูล?",
                text: "ยืนยันการลบข้อมูลหรือไม่",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes",
            }).then((result) => {
                if (result.isConfirmed) {
                    axios
                        .delete("/api/holiday/" + id)
                        .then((response) => {
                            //console.log(res);
                        })
                        .catch((err) => {
                            //console.log(err);
                        });
                    this.holidayList.splice(index, 1);
                    Swal.fire("ลบข้อมูล!", "ลบข้อมูลเรียบร้อย", "success");
                }
            });
        },
    },
};
</script>

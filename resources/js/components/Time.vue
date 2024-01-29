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
                    <tr class="bg-gray-100">
                        <th class="p-4 w-12">ID</th>
                        <th class="border p-4">รายละเอียด</th>
                        <th class="border p-4 w-48">จำนวนชั่วโมง/วัน</th>
                        <th class="border p-4">เวลาเริ่มต้น</th>
                        <th class="border p-4">สิ้นสุด</th>
                        <th class="border p-4">แก้ไขล่าสุด</th>
                        <th class="border p-4">วันที่แก้ไข</th>
                        <th class="border p-4">#</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-center">
                        <td class="border p-4">1</td>
                        <td class="border p-4">เวลาปกติ</td>
                        <td class="border p-4">10</td>
                        <td class="border p-4">08.00 น.</td>
                        <td class="border p-4">18.00 น.</td>
                        <td class="border p-4">วงศ์นรินทร์ สุขวิชัย</td>
                        <td class="border p-4">2024-01-23</td>
                        <td class="border p-4">
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
                                    ></box-icon>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr class="text-center">
                        <td class="border p-4">2</td>
                        <td class="border p-4">เสาร์ - อาทิตย์</td>
                        <td class="border p-4">8</td>
                        <td class="border p-4">10.00 น.</td>
                        <td class="border p-4">18.00 น.</td>
                        <td class="border p-4">วงศ์นรินทร์ สุขวิชัย</td>
                        <td class="border p-4">2024-01-23</td>
                        <td class="flex p-4 justify-center">
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
                                ></box-icon>
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
                        <div class="bg-white px-4 pt-5 sm:p-4 sm:pb-4 mt-4">
                            <div class="sm:flex sm:items-start">
                                <div
                                    class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10"
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
                                    <input
                                        type="text"
                                        class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                    />
                                </div>
                            </div>
                        </div>

                        <div
                            class="grid grid-cols-2 bg-white px-4 pb-4 sm:p-4 sm:pb-4"
                        >
                            <div class="sm:flex sm:items-start">
                                <div
                                    class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10"
                                >
                                    <box-icon name="time"></box-icon>
                                </div>
                                <div
                                    class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full"
                                >
                                    <label
                                        id="listbox-label"
                                        class="block text-sm font-medium leading-6 text-gray-900"
                                        >จำนวนชั่วโมง/วัน :
                                    </label>
                                    <input
                                        type="text"
                                        class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                        placeholder="10"
                                    />
                                </div>
                            </div>

                            <div class="sm:flex sm:items-start">
                                <div
                                    class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full"
                                >
                                    <label
                                        id="listbox-label"
                                        class="block text-sm font-medium leading-6 text-gray-900"
                                        >เวลาเริ่มต้น :
                                    </label>
                                    <input
                                        type="text"
                                        class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                        placeholder="08.00"
                                    />
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
    mounted() {},
    data() {
        return {
            isModalShow: false,
            data: {},
        };
    },
    methods: {
        showModal() {
            this.isModalShow = true;
        },
        close() {
            this.isModalShow = false;
        },
    },
};
</script>

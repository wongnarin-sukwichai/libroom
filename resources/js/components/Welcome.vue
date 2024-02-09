<template>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <img :src="banner" class="p-2 shadow-lg" />
    </div>

    <div class="bg-white rounded-lg">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <!-- Location -->
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mx-auto max-w-2xl lg:max-w-none">
                    <div
                        class="mt-6 space-y-12 lg:grid lg:grid-cols-2 lg:gap-x-6 lg:space-y-0"
                    >
                        <div
                            class="group relative"
                            v-for="(loc, index) in locList"
                            :key="index"
                        >
                            <div
                                class="relative h-80 w-full overflow-hidden rounded-lg sm:aspect-h-1 sm:aspect-w-2 lg:aspect-h-1 lg:aspect-w-1 sm:h-64 hover:opacity-75"
                                @click="pickCon(loc.id)"
                                :class="
                                    locActive === loc.id
                                        ? 'ring-2 ring-offset-2'
                                        : locGray === true
                                        ? 'grayscale-0'
                                        : 'grayscale'
                                "
                            >
                                <img
                                    :src="locPath + loc.pic"
                                    class="h-full w-full object-cover object-center cursor-pointer"
                                />
                            </div>
                            <h3 class="mt-6 text-sm text-gray-500">
                                {{ loc.eng }}
                            </h3>
                            <p class="text-base font-semibold text-gray-900">
                                {{ loc.title }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Arec Room -->
            <transition name="fade" mode="out-in">
                <div class="bg-white">
                    <div
                        class="mx-auto max-w-2xl px-4 py-8 sm:px-6 sm:py-12 lg:max-w-7xl lg:px-8"
                    >
                        <div
                            class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8"
                        >
                            <div
                                class="group"
                                v-for="(con, index) in showContainer"
                                :key="index"
                            >
                                <div
                                    class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg xl:aspect-h-8 xl:aspect-w-7"
                                    @click="
                                        pickRoom(con.id, con.time_1, con.time_2)
                                    "
                                    :class="
                                        conActive === con.id
                                            ? 'ring-2 ring-offset-2'
                                            : conGray === true
                                            ? 'grayscale-0'
                                            : 'grayscale'
                                    "
                                >
                                    <img
                                        :src="conPath + con.pic"
                                        class="h-full w-full object-cover object-center group-hover:opacity-75 cursor-pointer"
                                    />
                                </div>
                                <h3 class="mt-4 text-md text-gray-700">
                                    {{ con.title }}
                                </h3>
                                <p class="mt-1 text-xs text-gray-500">
                                    {{ con.detail }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </transition>

            <!-- Table -->
            <transition name="fade" mode="out-in">
                <div class="overflow-auto" v-if="tableList">
                    <table class="border-collapse">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border p-4">#</th>
                                <th class="border p-4 w-48">รายละเอียด</th>
                                <th
                                    class="border p-4"
                                    v-for="(n, index) in isTime.total"
                                    :key="index"
                                >
                                    {{ isTime.hour + index }}{{ isTime.minute }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(room, index) in roomList" :key="index">
                                <td class="border">
                                    <img
                                        :src="roomPath + room.pic"
                                        class="w-16 h-16"
                                    />
                                </td>
                                <td class="border p-4 text-center">
                                    {{ room.title }}
                                </td>
                                <template v-if="room.status === 0">
                                    <td
                                        class="border p-4 cursor-pointer hover:bg-sky-50"
                                        v-for="(n, index) in isTime.total"
                                        :key="index"
                                        @click="showModal(room.id, index)"
                                    ></td>
                                </template>
                                <template v-else>
                                    <td
                                        class="border p-4 bg-rose-50 text-center"
                                        :colspan="isTime.total"
                                    >
                                        ** งดให้บริการชั่วคราว **
                                    </td>
                                </template>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </transition>
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
                        <div class="bg-white px-4 pt-5 sm:p-4 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div
                                    class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-lime-100 sm:mx-0 sm:h-10 sm:w-10"
                                >
                                    <box-icon name="user"></box-icon>
                                </div>
                                <div
                                    class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full"
                                >
                                    <label
                                        id="listbox-label"
                                        class="block text-sm font-medium leading-6 text-gray-900"
                                    >
                                        รหัสนิสิต :</label
                                    >
                                    <input
                                        type="text"
                                        class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                        required
                                    />
                                </div>
                            </div>
                        </div>

                        <div class="bg-white px-4 pt-5 sm:p-4 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div
                                    class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-lime-100 sm:mx-0 sm:h-10 sm:w-10"
                                >
                                    <box-icon name="time"></box-icon>
                                </div>
                                <div
                                    class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full"
                                >
                                    <label
                                        id="listbox-label"
                                        class="block text-sm font-medium leading-6 text-gray-900"
                                    >
                                        จองเวลา :</label
                                    >
                                    <div
                                        class="grid grid-cols-4 p-3 border rounded-lg "
                                    >
                                        <label
                                            v-for="(n, index) in isTime.total"
                                            :key="index"
                                        >
                                            <input
                                                type="checkbox"
                                                class="mr-1 cursor-pointer"
                                            />
                                            {{ isTime.hour + index
                                            }}{{ isTime.minute }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div
                            class="grid grid-cols-2 bg-white px-4 pb-4 sm:p-4 sm:pb-4"
                        >
                            <div class="sm:flex sm:items-start">
                                <div
                                    class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-lime-100 sm:mx-0 sm:h-10 sm:w-10"
                                >
                                    <box-icon name="calendar"></box-icon>
                                </div>
                                <div
                                    class="text-center sm:ml-4 sm:text-left w-full"
                                >
                                    <label
                                        id="listbox-label"
                                        class="block text-sm font-medium leading-6 text-gray-900"
                                        >จองข้ามวัน
                                    </label>
                                    <div
                                        class="border p-4 rounded-lg"
                                    >
                                        <label>
                                            <input
                                                type="checkbox"
                                                class="mr-1 cursor-pointer"
                                            />
                                            วันพรุ่งนี้
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="sm:flex sm:items-start">
                                <div
                                    class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full"
                                ></div>
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
import axios from "axios";
export default {
    mounted() {
        this.getLocation();
        this.getContainer();
        this.isWeekend();
        this.getTime();
    },
    data() {
        return {
            isModalShow: false,
            banner: "img/banner.jpg",
            locPath: "img/locations/",
            conPath: "storage/containers/",
            roomPath: "storage/rooms/",
            tableList: false,
            locList: "",
            conList: "",
            showContainer: "",
            locActive: "", //กดคลิ๊กขึ้นกรอบน้ำเงิน
            locGray: true, //ภาพ gray scale
            conActive: "",
            conGray: true,
            roomList: "",
            timeList: "",
            weekend: "",
            isTime: "",
        };
    },
    methods: {
        getLocation() {
            axios
                .get("/api/locMain")
                .then((response) => {
                    this.locList = response.data;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        getContainer() {
            axios
                .get("/api/conMain")
                .then((response) => {
                    this.conList = response.data;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        getTime() {
            axios
                .get("/api/timeMain")
                .then((response) => {
                    this.timeList = response.data;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        pickCon(id) {
            let arr = [];
            let i = 0;
            this.conList.forEach((showCon) => {
                if (showCon.loc_id === id) {
                    arr[i] = showCon;
                    i++;
                }
            });
            this.showContainer = arr;
            this.locActive = id;
            this.locGray = false;
            this.conGray = true;
        },
        pickRoom(id, time_1, time_2) {
            if (this.weekend == false) {
                this.isTime = this.setTimer(time_1);
            } else {
                this.isTime = this.setTimer(time_2);
            }
            // console.log(this.isTime);
            axios
                .get("/api/roomMain/" + id)
                .then((response) => {
                    this.roomList = response.data;
                })
                .catch((err) => {
                    console.log(err);
                });
            this.tableList = true;
            this.conActive = id;
            this.conGray = false;
        },
        isWeekend() {
            //เช็ค เสาร์-อาทิตย์
            var result = new Date();
            if (result.getDay() == 6 || result.getDay() == 0) {
                return (this.weekend = true);
            } else {
                return (this.weekend = false);
            }
        },
        setTimer(id) {
            //ดึงวัน time table
            var result;
            this.timeList.forEach((showTime) => {
                if (showTime.id == id) {
                    result = showTime;
                }
            });
            return result;
        },
        showModal() {
            this.isModalShow = true;
        },
        close() {
            this.isModalShow = false;
        },
    },
};
</script>

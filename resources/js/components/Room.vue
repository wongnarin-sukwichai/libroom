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
                            name="cube"
                            color="gray"
                            size="md"
                            class="pr-2"
                        ></box-icon>
                        <span class="text-xl py-1">สร้างห้อง</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Button -->
        <div class="flex justify-end">
            <button
                class="bg-gray-200 hover:bg-gray-300 shadow-lg rounded-md p-2 text-sm text-gray-700"
                @click="back()"
            >
                กลับหน้าหลัก
            </button>
        </div>

        <!-- Cards -->
        <div class="relative flex flex-col justify-center overflow-hidden py-4">
            <div class="flex mx-auto w-full justify-center">
                <div class="w-72">
                    <div
                        class="relative flex flex-col shadow-md rounded-xl overflow-hidden hover:shadow-lg hover:-translate-y-1 transition-all duration-300 max-w-sm hover:cursor-pointer"
                    >
                        <div class="h-auto overflow-hidden">
                            <div class="h-36 overflow-hidden relative">
                                <img :src="conPath + conList.pic" alt="" />
                            </div>
                        </div>
                        <div class="bg-white py-4 px-3">
                            <h3 class="text-xs mb-2 font-medium">
                                {{ conList.title }}
                            </h3>
                            <div class="flex justify-between items-center">
                                <p class="text-xs text-gray-400">
                                    {{ conList.detail }}
                                </p>
                                <div
                                    class="relative z-40 flex items-center gap-2"
                                ></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr />

        <!-- Button -->
        <div class="flex justify-end py-4">
            <button
                class="bg-green-300 hover:bg-green-400 shadow-lg rounded-md p-2 text-sm text-gray-700"
                @click="showModal()"
            >
                เพิ่มข้อมูล
            </button>
        </div>

        <!-- Table -->
        <div class="overflow-auto justify-center">
            <table class="border-collapse">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border p-4">#</th>
                        <th class="border p-4 w-48">รายละเอียด</th>
                        <th
                            class="border p-4"
                            v-for="(n, index) in timeList.total"
                            :key="index"
                        >
                            {{ timeList.hour + index }}{{ timeList.minute }}
                        </th>
                        <th class="border p-4">#</th>
                    </tr>
                </thead>
                <tbody v-if="roomList">
                    <tr v-for="(room, index) in roomList" :key="index">
                        <td class="border">
                            <img :src="roomPath + room.pic" class="w-16 h-16" />
                        </td>
                        <td class="border p-4 text-center">{{ room.title }}</td>
                        <template v-if="room.status === 0">
                            <td
                                class="border p-4"
                                v-for="n in timeList.total"
                                :key="n"
                            ></td>
                        </template>
                        <template v-else>
                            <td
                                class="border p-4 bg-rose-50 text-center"
                                :colspan="timeList.total"
                            >
                                ** งดให้บริการชั่วคราว **
                            </td>
                        </template>
                        <td class="border p-4">
                            <box-icon
                                name="cog"
                                color="#94a3b8"
                                size="sm"
                                animation="tada-hover"
                                class="cursor-pointer mr-4"
                                @click="getEdit(room.id)"
                            ></box-icon>
                            <box-icon
                                v-if="room.status === 0"
                                name="play-circle"
                                color="#a3e635"
                                size="sm"
                                animation="tada-hover"
                                class="cursor-pointer"
                                @click="
                                    status(room.id, 1, 'ต้องการปิดชั่วคราว?')
                                "
                            ></box-icon>
                            <box-icon
                                v-else
                                name="stop-circle"
                                color="#f87171"
                                size="sm"
                                animation="tada-hover"
                                class="cursor-pointer"
                                @click="
                                    status(room.id, 0, 'ต้องการเปิดสาธารณะ?')
                                "
                            ></box-icon>
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
                    <!-- <div
                            class="grid grid-cols-2 bg-white px-4 pb-4 sm:p-4 sm:pb-4"
                        > -->
                        <div
                            class="bg-white px-4 pb-4 sm:p-4 sm:pb-4"
                        >
                            <div class="sm:flex sm:items-start">
                                <div
                                    class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-lime-100 sm:mx-0 sm:h-10 sm:w-10"
                                >
                                    <box-icon name="hash"></box-icon>
                                </div>
                                <div
                                    class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full"
                                >
                                    <label
                                        id="listbox-label"
                                        class="block text-sm font-medium leading-6 text-gray-900"
                                        >ประเภทห้อง :
                                    </label>
                                    {{ conList.title }}
                                </div>
                            </div>

                            <!-- <div class="sm:flex sm:items-start">
                                <div
                                    class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full"
                                >
                                    <label
                                        id="listbox-label"
                                        class="block text-sm font-medium leading-6 text-gray-900"
                                        >รูปภาพ :
                                    </label>
                                    <div class="flex">
                                        <input
                                            class="relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-neutral-300 bg-clip-padding px-3 py-[0.32rem] text-xs font-normal text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 file:px-3 file:py-[0.32rem] file:text-neutral-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-neutral-200 focus:border-primary focus:text-neutral-700 focus:shadow-te-primary focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:file:bg-neutral-700 dark:file:text-neutral-100 dark:focus:border-primary mr-2"
                                            ref="fileInput"
                                            type="file"
                                            @input="pickFile"
                                        />
                                        <button
                                            type="button"
                                            class="rounded-md bg-white px-2.5 text-sm text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 hover:text-gray-500 hover:bg-gray-50"
                                            @click="resetFile()"
                                        >
                                            <box-icon
                                                name="trash"
                                                size="xs"
                                                color="#f87171"
                                                class=""
                                            ></box-icon>
                                        </button>
                                    </div>
                                    <transition name="fade" mode="out-in">
                                        <div
                                            class="text-red-500 text-sm"
                                            v-show="chkPic === false"
                                        >
                                            ** กรุณาเลือกรูป
                                        </div>
                                    </transition>
                                </div>
                            </div> -->
                        </div>
<!-- 
                        <div class="flex px-4 justify-center">
                            <transition name="fade" mode="out-in">
                                <div
                                    v-if="previewImage"
                                    class="imagePreviewWrapper"
                                    :style="{
                                        'background-image': `url(${previewImage})`,
                                    }"
                                    @click="selectImage"
                                ></div>
                            </transition>
                        </div> -->

                        <div class="bg-white px-4 pt-5 sm:p-4 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div
                                    class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-lime-100 sm:mx-0 sm:h-10 sm:w-10"
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
                                        >ชื่อห้อง :
                                    </label>
                                    <input
                                        type="text"
                                        class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                        required
                                        v-model="data.title"
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

    <!-- Modal Edit -->
    <transition name="fade" mode="out-in">
        <div
            class="relative z-10"
            aria-labelledby="modal-title"
            role="dialog"
            aria-modal="true"
            v-show="isModalEdit"
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
                        @submit.prevent="update()"
                    >
                        <!-- <div
                            class="grid grid-cols-2 bg-white px-4 pb-4 sm:p-4 sm:pb-4"
                        > -->
                        <div
                            class="bg-white px-4 pb-4 sm:p-4 sm:pb-4"
                        >
                            <div class="sm:flex sm:items-start">
                                <div
                                    class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-amber-100 sm:mx-0 sm:h-10 sm:w-10"
                                >
                                    <box-icon name="hash"></box-icon>
                                </div>
                                <div
                                    class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full"
                                >
                                    <label
                                        id="listbox-label"
                                        class="block text-sm font-medium leading-6 text-gray-900"
                                        >ประเภทห้อง :
                                    </label>
                                    {{ conList.title }}
                                </div>
                            </div>

                            <!-- <div class="sm:flex sm:items-start">
                                <div
                                    class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full"
                                >
                                    <label
                                        id="listbox-label"
                                        class="block text-sm font-medium leading-6 text-gray-900"
                                        >รูปภาพ :
                                    </label>
                                    <div class="flex">
                                        <input
                                            class="relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-neutral-300 bg-clip-padding px-3 py-[0.32rem] text-xs font-normal text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 file:px-3 file:py-[0.32rem] file:text-neutral-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-neutral-200 focus:border-primary focus:text-neutral-700 focus:shadow-te-primary focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:file:bg-neutral-700 dark:file:text-neutral-100 dark:focus:border-primary mr-2"
                                            ref="fileInput"
                                            type="file"
                                            @input="pickFile"
                                        />
                                        <button
                                            type="button"
                                            class="rounded-md bg-white px-2.5 text-sm text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 hover:text-gray-500 hover:bg-gray-50"
                                            @click="resetFile()"
                                        >
                                            <box-icon
                                                name="trash"
                                                size="xs"
                                                color="#f87171"
                                                class=""
                                            ></box-icon>
                                        </button>
                                    </div>
                                    <transition name="fade" mode="out-in">
                                        <div
                                            class="text-red-500 text-sm"
                                            v-show="chkPic === false"
                                        >
                                            ** กรุณาเลือกรูป
                                        </div>
                                    </transition>
                                </div>
                            </div> -->
                        </div>

                        <!-- <div class="flex px-4 justify-center">
                            <transition name="fade" mode="out-in">
                                <div
                                    v-if="previewImage"
                                    class="imagePreviewWrapper"
                                    :style="{
                                        'background-image': `url(${previewImage})`,
                                    }"
                                    @click="selectImage"
                                ></div>
                            </transition>
                        </div> -->

                        <div class="bg-white px-4 pt-5 sm:p-4 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div
                                    class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-amber-100 sm:mx-0 sm:h-10 sm:w-10"
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
                                        >ชื่อห้อง :
                                    </label>
                                    <input
                                        type="text"
                                        class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                        required
                                        v-model="dataEdit.title"
                                    />
                                </div>
                            </div>
                        </div>

                        <div
                            class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6"
                        >
                            <button
                                type="submit"
                                class="inline-flex w-full justify-center rounded-md bg-amber-400 px-3 py-2 text-sm text-white shadow-sm hover:bg-amber-500 sm:ml-3 sm:w-auto"
                            >
                                ปรับปรุงข้อมูล
                            </button>
                            <button
                                type="button"
                                class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm text-gray-900 shadow-sm hover:bg-gray-50 ring-1 ring-inset ring-gray-300 sm:mt-0 sm:w-auto"
                                @click="closeEdit()"
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
import Swal from "sweetalert2";

export default {
    mounted() {
        this.getContainer();
        this.getRoom();
    },
    data() {
        return {
            isModalShow: false,
            isModalEdit: false,
            conPath: "../img/containers/",
            roomPath: "../img/rooms/",
            previewImage: "",
            file: null,
            chkPic: true,
            conList: "",
            roomList: "",
            timeList: "",
            data: {
                pic: "",
                loc_id: "",
                con_id: this.$route.params.id,
                title: "",
            },
            dataEdit: {
                id: "",
                pic: "",
                title: "",
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
        closeEdit() {
            this.isModalEdit = false;
        },
        back() {
            this.$router.push("/container");
        },
        async getContainer() {
            await axios
                .get("/api/container/" + this.$route.params.id)
                .then((response) => {
                    this.conList = response.data;
                })
                .catch((err) => {
                    console.log(err);
                });

            await axios
                .get("/api/time/" + this.conList.time_1)
                .then((response) => {
                    this.timeList = response.data;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        getRoom() {
            axios
                .get("/api/room/" + this.$route.params.id)
                .then((response) => {
                    this.roomList = response.data;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        resetFile() {
            this.$refs.fileInput.value = null; //clear ช่อง choose
            this.previewImage = "";
            this.file = "";
        },
        //image upload and preview methods
        selectImage() {
            this.$refs.fileInput.click();
        },
        pickFile() {
            let input = this.$refs.fileInput;
            this.file = input.files; //เอาไฟล์รูปเข้าตัวแปร file
            //console.log(this.file[0])
            if (this.file && this.file[0]) {
                let reader = new FileReader();
                reader.onload = (e) => {
                    this.previewImage = e.target.result;
                    //this.file = e.target.files[0];
                };
                reader.readAsDataURL(this.file[0]);
                this.$emit("input", this.file[0]);
            }
        },
        async send() {
            this.data.loc_id = await this.conList.loc_id;

            await this.$store.dispatch("storeRoom", this.data);
            await Swal.fire({
                position: "top-end",
                icon: "success",
                title: "บันทึกข้อมูลเรียบร้อย",
                showConfirmButton: false,
                timer: 1500,
            });
            this.isModalShow = false;
            setTimeout(() => {
                this.getRoom();
            }, "1500");
        },
        // บังคับ upload รูปภาพ
        // async send() {
        //     if (this.file == null) {
        //         this.chkPic = false;
        //     } else {
        //         let formData = new FormData(); //สร้าง FromData เพื่อรองรับข้อมูลประเภท File
        //         formData.append("file", this.file[0]);
        //         // console.log(formData);

        //         await this.$store.dispatch("uploadPicRoom", formData);
        //         this.data.pic = await this.$store.getters.picName;
        //         this.data.loc_id = await this.conList.loc_id;

        //         await this.$store.dispatch("storeRoom", this.data);
        //         await Swal.fire({
        //             position: "top-end",
        //             icon: "success",
        //             title: "บันทึกข้อมูลเรียบร้อย",
        //             showConfirmButton: false,
        //             timer: 1500,
        //         });
        //         this.isModalShow = false;
        //         setTimeout(() => {
        //             this.getRoom()
        //         }, "1500");
        //     }
        // },
        getEdit(id) {
            // console.log(id);
            this.isModalEdit = true;
            axios
                .get("/api/room/" + id + "/edit")
                .then((response) => {
                    this.dataEdit.id = response.data.id;
                    this.dataEdit.pic = response.data.pic;
                    this.dataEdit.title = response.data.title;
                    this.previewImage = this.roomPath + response.data.pic;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        async update() {
            try {             
                await this.$store.dispatch("updateRoom", this.dataEdit);
                await Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "บันทึกข้อมูลเรียบร้อย",
                    showConfirmButton: false,
                    timer: 1500,
                });
                this.isModalEdit = false;
                setTimeout(() => {
                    this.getRoom();
                }, "1500");
            } catch (err) {
                console.log(err);
            }
        },
        // บังคับ upload รูปภาพ
        // async update() {
        //     try {
        //         if (this.file != null) {
        //             let formData = new FormData(); //สร้าง FromData เพื่อรองรับข้อมูลประเภท File
        //             formData.append("file", this.file[0]);

        //             await this.$store.dispatch("uploadPicRoom", formData);
        //             this.dataEdit.pic = await this.$store.getters.picName;
        //         }

        //         await this.$store.dispatch("updateRoom", this.dataEdit);
        //         await Swal.fire({
        //             position: "top-end",
        //             icon: "success",
        //             title: "บันทึกข้อมูลเรียบร้อย",
        //             showConfirmButton: false,
        //             timer: 1500,
        //         });
        //         this.isModalEdit = false;
        //         setTimeout(() => {
        //             this.getRoom();
        //         }, "1500");
        //     } catch (err) {
        //         console.log(err);
        //     }
        // },
        async status(id, code, text) {
            Swal.fire({
                title: text,
                text: "ยืนยันการเปลี่ยนสถานะ?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes",
            }).then((result) => {
                if (result.isConfirmed) {
                    axios
                        .get("/api/roomStatus/" + id + "/" + code)
                        .then((response) => {
                            Swal.fire({
                                position: "top-end",
                                icon: "success",
                                title: "บันทึกข้อมูลเรียบร้อย",
                                showConfirmButton: false,
                                timer: 1500,
                            });
                            setTimeout(() => {
                                this.getRoom();
                            }, "1500");
                        })
                        .catch((err) => {
                            //console.log(err);
                        });
                }
            });
        },
    },
};
</script>

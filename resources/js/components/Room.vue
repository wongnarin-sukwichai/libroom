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
                            name="package"
                            color="gray"
                            size="md"
                            class="pr-2"
                        ></box-icon>
                        <span class="text-xl py-1">สร้างห้อง</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cards -->
        <div class="relative flex flex-col justify-center overflow-hidden py-6">
            <div class="mx-auto max-w-screen-xl px-4 w-full">
                <div class="grid w-full sm:grid-cols-2 xl:grid-cols-4 gap-6">
                    <div
                        class="relative flex flex-col shadow-md rounded-xl overflow-hidden hover:shadow-lg hover:-translate-y-1 transition-all duration-300 max-w-sm hover:cursor-pointer"
                        v-for="(loc, index) in locationList"
                        :key="index"
                        @click="getContainer(loc.id)"
                    >
                        <div class="h-auto overflow-hidden">
                            <div class="h-36 overflow-hidden relative">
                                <img :src="locPath + loc.pic" alt="" />
                            </div>
                        </div>
                        <div class="bg-white py-4 px-3">
                            <h3 class="text-xs mb-2 font-medium">
                                {{ loc.title }}
                            </h3>
                            <div class="flex justify-between items-center">
                                <p class="text-xs text-gray-400">
                                    {{ loc.eng }}
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
        <div class="flex justify-end my-4">
            <button
                class="bg-green-300 hover:bg-green-400 shadow-lg rounded-md p-2 text-sm text-gray-700"
                @click="showModal()"
            >
                เพิ่มข้อมูล
            </button>
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
                            class="grid grid-cols-2 bg-white px-4 pb-4 sm:p-4 sm:pb-4"
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
                                        >ที่ตั้ง :
                                    </label>
                                    <select
                                        class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        required
                                        v-model="data.loc_id"
                                    >
                                        <option disabled value="" selected>
                                            กรุณาเลือก...
                                        </option>
                                        <option
                                            v-for="(loc, index) in locationList"
                                            :key="index"
                                            :value="loc.id"
                                        >
                                            {{ loc.title }}
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
                            </div>
                        </div>

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
                        </div>

                        <div class="bg-white px-4 pt-5 sm:p-4 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div
                                    class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-lime-100 sm:mx-0 sm:h-10 sm:w-10"
                                >
                                    <box-icon name="package"></box-icon>
                                </div>
                                <div
                                    class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full"
                                >
                                    <label
                                        id="listbox-label"
                                        class="block text-sm font-medium leading-6 text-gray-900"
                                    >
                                        ชื่อห้อง :</label
                                    >
                                    <input
                                        type="text"
                                        class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                        required
                                        v-model="data.title"
                                    />
                                </div>
                            </div>
                        </div>

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
        this.getLocation();
    },
    data() {
        return {
            isModalShow: false,
            locPath: "img/locations/",
            previewImage: "",
            file: null,
            chkPic: true,
            locationList: "",
            containerList: "",
            data: {
                loc_id: "",
                pic: "",
                title: "",
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
        getLocation() {
            axios
                .get("/api/location")
                .then((response) => {
                    this.locationList = response.data;
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
            if (this.file == null) {
                this.chkPic = false;
            } else {
                let formData = new FormData(); //สร้าง FromData เพื่อรองรับข้อมูลประเภท File
                formData.append("file", this.file[0]);

                await this.$store.dispatch("uploadPicContainer", formData);
                this.data.pic = await this.$store.getters.picName

                await this.$store.dispatch('storeContainer', this.data)
                await Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "บันทึกข้อมูลเรียบร้อย",
                    showConfirmButton: false,
                    timer: 1500,
                });
                this.isModalShow = false;
            }
        },
    },
};
</script>

<style>
.imagePreviewWrapper {
    width: 250px;
    height: 250px;
    display: block;
    cursor: pointer;
    margin: 0 auto;
    background-size: cover;
    background-position: center center;
}

.ck-editor__editable {
    max-height: 400px;
}
</style>

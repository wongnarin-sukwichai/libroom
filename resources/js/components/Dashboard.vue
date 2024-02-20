<template>
    <div class="container" v-for="(loc, index) in locList" :key="index">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="flex card-header">
                        <box-icon
                            name="dots-vertical-rounded"
                            size="md"
                            class="pr-2"
                        ></box-icon>
                        <img
                            :src="locPath + loc.pic"
                            class="h-8 w-8 rounded-lg mr-4"
                        />
                        <span class="text-lg py-1 text-gray-500"
                            >{{ loc.title }} :
                            <font class="text-sm">{{ loc.eng }}</font></span
                        >
                    </div>
                </div>
            </div>
        </div>

        <!-- Cards Container -->
        <div class="flex justify-center w-full">
            <div
                class="relative flex flex-col justify-center overflow-hidden py-4"
            >
                <div class="mx-auto max-w-screen-xl px-4 w-full">
                    <div
                        class="grid w-full sm:grid-cols-2 xl:grid-cols-4 gap-4"
                    >
                        <div
                            class="relative flex flex-col shadow-md rounded-xl overflow-hidden hover:shadow-lg hover:-translate-y-1 transition-all duration-300 max-w-sm"
                            v-for="(con, index) in conList"
                            :key="index"
                        >
                            <template
                            v-if="loc.id === con.loc_id"
                            >
                                <div
                                    class="h-auto overflow-hidden hover:cursor-pointer"
                                    @click="getRoom(con.id)"
                                >
                                    <div
                                        class="h-36 overflow-hidden relative"
                                        :class="
                                            con.status === 1 ? 'grayscale' : ''
                                        "
                                    >
                                        <img :src="conPath + con.pic" alt="" />
                                    </div>
                                </div>
                                <div class="bg-white py-4 px-3">
                                    <h3 class="text-xs mb-2 font-medium">
                                        {{ con.title }}
                                    </h3>
                                    <div
                                        class="flex justify-between items-center"
                                    >
                                        <p class="text-xs text-gray-400">
                                            {{ con.detail }}
                                        </p>                                       
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import "boxicons";
export default {
    mounted() {
        this.getLocation();
        this.getContainer();
    },
    data() {
        return {
            locPath: "img/locations/",
            conPath: "storage/containers/",
            locList: "",
            conList: ""
        };
    },
    methods: {
        getLocation() {
            axios
                .get("/api/location")
                .then((response) => {
                    this.locList = response.data;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        getContainer() {
            axios
                .get("/api/container")
                .then((response) => {
                    this.conList = response.data;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        getRoom(id) {
            this.$router.push("/reserve/" + id);
        },
    },
};
</script>

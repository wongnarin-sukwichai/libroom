<template>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <img :src="banner" class="p-2 shadow-lg" />
    </div>

    <div class="bg-white rounded-lg">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <!-- Location -->
            <div
                class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8"
                v-show="showLoc"
            >
                <div class="mx-auto max-w-2xl lg:max-w-none">
                    <div
                        class="mt-6 space-y-12 lg:grid lg:grid-cols-2 lg:gap-x-6 lg:space-y-0"
                    >
                        <div
                            class="group relative"
                            v-for="(loc, index) in locationList"
                            :key="index"
                        >
                            <div
                                class="relative h-80 w-full overflow-hidden rounded-lg bg-white sm:aspect-h-1 sm:aspect-w-2 lg:aspect-h-1 lg:aspect-w-1 sm:h-64 hover:opacity-75 ring-2 ring-offset-2 ring-blue-400"
                                @click="showRoom(loc.id)"
                                >
                                <img
                                    :src="location + loc.pic"
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
                <div class="bg-white" v-show="showArec">
                    <div
                        class="mx-auto max-w-2xl px-4 py-8 sm:px-6 sm:py-12 lg:max-w-7xl lg:px-8"
                    >
                        <div
                            class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8"
                        >
                            <div class="">
                                <div
                                    class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-h-8 xl:aspect-w-7 cursor-pointer opacity-75"
                                >
                                    <img
                                        :src="img_a"
                                        class="h-full w-full object-cover object-center"
                                    />
                                </div>
                                <h3 class="mt-4 text-lg text-gray-700">
                                    ห้องศึกษาค้นคว้า A
                                </h3>
                                <p class="mt-1 text-xs text-gray-500">
                                    ใช้บริการ 3-6 คน
                                </p>
                            </div>
                            <div class="group">
                                <div
                                    class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-h-8 xl:aspect-w-7"
                                >
                                    <img
                                        :src="img_b"
                                        class="h-full w-full object-cover object-center group-hover:opacity-75"
                                    />
                                </div>
                                <h3 class="mt-4 text-md text-gray-700">
                                    ห้องศึกษาค้นคว้า B
                                </h3>
                                <p class="mt-1 text-xs text-gray-500">
                                    ใช้บริการ 3-6 คน
                                </p>
                            </div>
                            <div class="group">
                                <div
                                    class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-h-8 xl:aspect-w-7"
                                >
                                    <img
                                        :src="img_c"
                                        class="h-full w-full object-cover object-center group-hover:opacity-75"
                                    />
                                </div>
                                <h3 class="mt-4 text-md text-gray-700">
                                    ห้องศึกษาค้นคว้า C
                                </h3>
                                <p class="mt-1 text-xs text-gray-500">
                                    ใช้บริการ 5-10 คน
                                </p>
                            </div>
                            <div class="group">
                                <div
                                    class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-h-8 xl:aspect-w-7"
                                >
                                    <img
                                        :src="img_d"
                                        class="h-full w-full object-cover object-center group-hover:opacity-75"
                                    />
                                </div>
                                <h3 class="mt-4 text-md text-gray-700">
                                    PLAYGROUND
                                </h3>
                                <p class="mt-1 text-xs text-gray-500">
                                    ใช้บริการ 3-15 คน
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </transition>

            <!-- Dlp Room -->
            <transition name="fade" mode="out-in">
                <div class="bg-white" v-show="showDlp">
                    <div
                        class="mx-auto max-w-2xl px-4 py-8 sm:px-6 sm:py-12 lg:max-w-7xl lg:px-8"
                    >
                        <h2 class="sr-only">Products</h2>

                        <div
                            class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8"
                        >
                            <div class="group">
                                <div
                                    class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-h-8 xl:aspect-w-7"
                                >
                                    <img
                                        :src="img_a"
                                        class="h-full w-full object-cover object-center group-hover:opacity-75"
                                    />
                                </div>
                                <h3 class="mt-4 text-lg text-gray-700">
                                    ห้องศึกษาค้นคว้า A
                                </h3>
                                <p class="mt-1 text-xs text-gray-500">
                                    ใช้บริการ 3-6 คน
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </transition>

            <!-- Table -->
            <div class="overflow-auto">
                <table class="border-collapse" v-if="!tableList">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border p-4">#</th>
                            <th class="border p-4 w-48">รายละเอียด</th>
                            <th class="border p-4">8.00 น.</th>
                            <th class="border p-4">9.00 น.</th>
                            <th class="border p-4">10.00 น.</th>
                            <th class="border p-4">11.00 น.</th>
                            <th class="border p-4">12.00 น.</th>
                            <th class="border p-4">13.00 น.</th>
                            <th class="border p-4">14.00 น.</th>
                            <th class="border p-4">15.00 น.</th>
                            <th class="border p-4">16.00 น.</th>
                            <th class="border p-4">17.00 น.</th>
                            <th class="border p-4">18.00 น.</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border">
                                <img :src="img_a1" class="w-16 h-16" />
                            </td>
                            <td class="border p-4 text-center">หมายเลข 1</td>
                            <td class="border p-4"></td>
                            <td class="border p-4"></td>
                            <td class="border p-4"></td>
                            <td class="border p-4"></td>
                            <td class="border p-4"></td>
                            <td class="border p-4"></td>
                            <td class="border p-4"></td>
                            <td class="border p-4"></td>
                            <td class="border p-4"></td>
                            <td class="border p-4"></td>
                            <td class="border p-4"></td>
                        </tr>
                        <tr>
                            <td class="border"></td>
                            <td class="border p-4 text-center">หมายเลข 2</td>
                            <td class="border p-4"></td>
                            <td class="border p-4"></td>
                            <td class="border p-4"></td>
                            <td class="border p-4"></td>
                            <td class="border p-4"></td>
                            <td class="border p-4"></td>
                            <td class="border p-4"></td>
                            <td class="border p-4"></td>
                            <td class="border p-4"></td>
                            <td class="border p-4"></td>
                            <td class="border p-4"></td>
                        </tr>
                        <tr>
                            <td class="border"></td>
                            <td class="border p-4 text-center">หมายเลข 3</td>
                            <td class="border p-4"></td>
                            <td class="border p-4"></td>
                            <td class="border p-4"></td>
                            <td class="border p-4"></td>
                            <td class="border p-4"></td>
                            <td class="border p-4"></td>
                            <td class="border p-4"></td>
                            <td class="border p-4"></td>
                            <td class="border p-4"></td>
                            <td class="border p-4"></td>
                            <td class="border p-4"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        this.getLocation();
    },
    data() {
        return {
            banner: "img/banner.jpg",
            location: "img/locations/",
            img_1: "/img/arec.jpg",
            img_2: "/img/dlp.jpg",
            img_a: "/img/a.jpg",
            img_b: "/img/b.jpg",
            img_c: "/img/c.jpg",
            img_d: "/img/d.jpg",
            img_a1: "/img/a1.jpg",
            showLoc: true,
            showArec: false,
            showDlp: false,
            showTable: false,
            tableList: "",
            locationList: "",
        };
    },
    methods: {
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
        showRoom(id) {
            console.log(id)
            if (id === 1) {
                this.showDlp = false;
                this.showArec = true;
            } else {
                this.showArec = false;
                this.showDlp = true;
            }
        },
    },
};
</script>

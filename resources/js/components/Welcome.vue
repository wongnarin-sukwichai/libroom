<template>
    <div class="bg-white rounded-lg">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mx-auto max-w-2xl lg:max-w-none">
                    <div
                        class="mt-6 space-y-12 lg:grid lg:grid-cols-2 lg:gap-x-6 lg:space-y-0"
                    >
                        <div class="group relative">
                            <div
                                class="relative h-80 w-full overflow-hidden rounded-lg bg-white sm:aspect-h-1 sm:aspect-w-2 lg:aspect-h-1 lg:aspect-w-1 group-hover:opacity-75 sm:h-64"
                            >
                                <img
                                    :src="img_1"
                                    alt="Desk with leather desk pad, walnut desk organizer, wireless keyboard and mouse, and porcelain mug."
                                    class="h-full w-full object-cover object-center"
                                />
                            </div>
                            <h3 class="mt-6 text-sm text-gray-500">
                                <a href="#">
                                    <span class="absolute inset-0"></span>
                                    Academic Resource Center
                                </a>
                            </h3>
                            <p class="text-base font-semibold text-gray-900">
                                สำนักวิทยบริการ
                            </p>
                        </div>
                        <div class="group relative">
                            <div
                                class="relative h-80 w-full overflow-hidden rounded-lg bg-white sm:aspect-h-1 sm:aspect-w-2 lg:aspect-h-1 lg:aspect-w-1 group-hover:opacity-75 sm:h-64"
                            >
                                <img
                                    :src="img_2"
                                    alt="Wood table with porcelain mug, leather journal, brass pen, leather key ring, and a houseplant."
                                    class="h-full w-full object-cover object-center"
                                />
                            </div>
                            <h3 class="mt-6 text-sm text-gray-500">
                                <a href="#">
                                    <span class="absolute inset-0"></span>
                                    Digital Learning Park
                                </a>
                            </h3>
                            <p class="text-base font-semibold text-gray-900">
                                Digital Learning Park (DLP)
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Room -->
            <div class="bg-white">
                <div
                    class="mx-auto max-w-2xl px-4 py-8 sm:px-6 sm:py-12 lg:max-w-7xl lg:px-8"
                >
                    <h2 class="sr-only">Products</h2>

                    <div
                        class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8"
                    >
                        <a href="#" class="group">
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
                            <p class="mt-1 text-xs text-gray-500">ใช้บริการ 3-6 คน</p>                      
                        </a>
                        <a href="#" class="group">
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
                            <p class="mt-1 text-xs text-gray-500">ใช้บริการ 3-6 คน</p>
                        </a>
                        <a href="#" class="group">
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
                            <p class="mt-1 text-xs text-gray-500">ใช้บริการ 5-10 คน</p>
                        </a>
                        <a href="#" class="group">
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
                            <p class="mt-1 text-xs text-gray-500">ใช้บริการ 3-15 คน</p>
                        </a>

                        <!-- More products... -->
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-auto">
                <table class="border-collapse border rounded-lg">
                    <thead>
                        <tr>
                            <th class="border p-4">#</th>
                            <th class="border p-4">รูปภาพ</th>
                            <th class="border p-4 w-32">รายละเอียด</th>
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
                            <td class="border p-4">1</td>
                            <td class="border p-4"></td>
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
                            <td class="border p-4">2</td>
                            <td class="border p-4"></td>
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
                            <td class="border p-4">3</td>
                            <td class="border p-4"></td>
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
    mounted() {},
    data() {
        return {
            img_1: "/img/arec.jpg",
            img_2: "/img/dlp.jpg",
            img_a: "/img/a.jpg",
            img_b: "/img/b.jpg",
            img_c: "/img/c.jpg",
            img_d: "/img/d.jpg",
        };
    },
};
</script>

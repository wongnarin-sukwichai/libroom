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
                                สำนักวิทยบริการ อาคาร A
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
                                Digital Learning Park (DLP) อาคาร B
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class='overflow-auto'>
                <table class="border-collapse border rounded-lg my-12">
                    <thead>
                        <tr>
                            <th class="border p-4">#</th>
                            <th class="border p-4">รายละเอียด</th>
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
                            <td class="border p-4">Indiana</td>
                            <td class="border p-4">Indianapolis</td>
                        </tr>
                        <tr>
                            <td class="border p-4">Ohio</td>
                            <td class="border p-4">Columbus</td>
                        </tr>
                        <tr>
                            <td class="border p-4">Michigan</td>
                            <td class="border p-4">Detroit</td>
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
        };
    },
};
</script>

<template>
    <div class="min-h-full">
        <nav class="bg-gradient-to-r from-rose-400 via-fuchsia-500 to-indigo-500">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <img
                                class="h-4 w-8"
                                :src="library"
                                alt="Your Company"
                            />
                        </div>
                        <div class="hidden md:block">
                            <div class="ml-10 flex items-baseline space-x-4">
                                <!-- Current: "bg-gray-900 text-gray-900", Default: "text-gray-50 hover:bg-gray-50 hover:text-gray-900" -->
                                <router-link
                                    to="/"
                                    class="text-gray-50 hover:bg-gray-50 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium"
                                    >หน้าแรก</router-link
                                >

                                <router-link
                                    to="/advertise"
                                    class="text-gray-50 hover:bg-gray-50 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium"
                                    >ข้อปฏิบัติการเข้าใช้บริการ</router-link
                                >

                                <router-link
                                    to="/guide"
                                    class="text-gray-50 hover:bg-gray-50 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium"
                                    >แบบประเมินความพึงพอใจ</router-link
                                >
                                <router-link
                                    to="/guide"
                                    class="text-gray-50 hover:bg-gray-50 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium"
                                    >คู่มือการใช้งานระบบ</router-link
                                >
                            </div>
                        </div>
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-4 flex items-center md:ml-6">
                            <!-- Profile dropdown -->
                            <div class="relative ml-3">
                                <div v-if="!user">
                                    <router-link
                                        to="/login"
                                        class="text-gray-50 hover:bg-gray-50 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium"
                                        >เข้าสู่ระบบ</router-link
                                    >
                                </div>
                                <div v-else>
                                    <button
                                        type="button"
                                        class="relative flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                                        id="user-menu-button"
                                        aria-expanded="false"
                                        aria-haspopup="true"
                                        @click="show = !show"
                                    >
                                        <div class="flex items-center px-5">
                                            <div class="mr-3">
                                                <div
                                                    class="text-base font-medium leading-none text-gray-900 text-left"
                                                >
                                                
                                                </div>
                                                <div
                                                    class="text-sm font-medium leading-none text-gray-50"
                                                >
                                                
                                                </div>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <box-icon
                                                    name="user"
                                                    color="white"
                                                ></box-icon>
                                            </div>
                                        </div>
                                    </button>
                                </div>

                                <transition name="fade" mode="out-in"
                                >
                                    <div
                                        class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                        role="menu"
                                        aria-orientation="vertical"
                                        aria-labelledby="user-menu-button"
                                        tabindex="-1"
                                        v-if="show"
                                    >
                                        <!-- Active: "bg-gray-100", Not Active: "" -->
                                        <router-link
                                            to="../home"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200"
                                            role="menuitem"
                                            tabindex="-1"
                                            id="user-menu-item-0"
                                            >ระบบหลังบ้าน</router-link
                                        >
                                        <a
                                            href="#"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200"
                                            role="menuitem"
                                            tabindex="-1"
                                            id="user-menu-item-2"
                                            @click="logout()"
                                            >ออกจากระบบ</a
                                        >
                                    </div>
                                </transition>
                            </div>
                        </div>
                    </div>

                    <div class="-mr-2 flex md:hidden">
                        <!-- Mobile menu button -->
                        <button
                            type="button"
                            class="relative inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-50 hover:bg-gray-50 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                            aria-controls="mobile-menu"
                            aria-expanded="false"
                            @click="showNav = !showNav"
                        >
                            <!-- Menu open: "hidden", Menu closed: "block" -->
                            <svg
                                class="block h-6 w-6"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"
                                />
                            </svg>
                            <!-- Menu open: "block", Menu closed: "hidden" -->
                            <svg
                                class="hidden h-6 w-6"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M6 18L18 6M6 6l12 12"
                                />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile menu, show/hide based on menu state. -->
            <div class="md:hidden" id="mobile-menu" 
            v-if="showNav"           
            >
                <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
                    <!-- Current: "bg-gray-900 text-gray-900", Default: "text-gray-50 hover:bg-gray-50 hover:text-gray-900" -->
                    <router-link
                        to="/"
                        class="text-gray-50 hover:bg-gray-50 hover:text-gray-900 cursor-pointer block rounded-md px-3 py-2 text-base font-medium"
                        >หน้าแรก</router-link
                    >
                    <router-link
                        to="/advertise"
                        class="text-gray-50 hover:bg-gray-50 hover:text-gray-900 cursor-pointer block rounded-md px-3 py-2 text-base font-medium"
                        >ข้อปฏิบัติการเข้าใช้บริการ</router-link
                    >
                    <router-link
                        to="/guide"
                        class="text-gray-50 hover:bg-gray-50 hover:text-gray-900 cursor-pointer block rounded-md px-3 py-2 text-base font-medium"
                        >แบบประเมินความพึงพอใจ</router-link
                    >
                    <router-link
                        to="/guide"
                        class="text-gray-50 hover:bg-gray-50 hover:text-gray-900 cursor-pointer block rounded-md px-3 py-2 text-base font-medium"
                        >คู่มือการใช้งานระบบ</router-link
                    >
                </div>
                <div class="border-t border-gray-700 pb-3 pt-4">
                    <div class="flex items-center px-5">
                        <div class="flex-shrink-0">
                            <box-icon name="user" color="white"></box-icon>
                        </div>
                        <div class="ml-3">
                            <div
                                class="text-base font-medium leading-none text-gray-900"
                            >
                             
                            </div>
                            <div
                                class="text-sm font-medium leading-none text-gray-50"
                            >
                           
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 space-y-1 px-2">
                        <a
                            href="#"
                            class="block rounded-md px-3 py-2 text-base font-medium text-gray-50 hover:bg-gray-50 hover:text-gray-900"
                            @click="logout()"
                            >ออกจากระบบ</a
                        >
                    </div>
                </div>
            </div>
        </nav>
        <!-- Replace with your content -->
        <main>
            <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                <img :src="banner" class="p-2 shadow-lg" />
            </div>

            <router-view v-slot="{ Component, route }">
                <transition name="fade" mode="out-in">
                    <div :key="route.name">
                        <component :is="Component"> </component>
                    </div>
                </transition>
            </router-view>

            <footer
                class="footer footer-center text-base-content border-t h-auto bottom-0 w-screen text-gray-50 mt-10 bg-gradient-to-r from-rose-400 via-fuchsia-500 to-indigo-500"
            >
                <div class="py-4 text-sm text-center dark:text-gray-50">
                    ©2024 Academic Resource Center MSU
                </div>
            </footer>
        </main>
        <!-- /End replace -->
    </div>
</template>

<script>
import "boxicons";

export default {
    data() {
        return {
            library: "img/library.png",
            banner: "img/banner.jpg",
            user: "",
            showNav: false,
        };
    },
    methods: {
        async logout() {
            this.show = false;
            this.showNav = false;
            await this.$store.dispatch("logout");
            this.$router.push({ name: "login" });
        },
    },
    computed: {
        user() {
            return this.$store.getters.user;
        },
    },
};
</script>

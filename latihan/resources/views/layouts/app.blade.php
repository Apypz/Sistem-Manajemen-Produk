<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link crossorigin="" href="https://fonts.gstatic.com/" rel="preconnect" />
    <link as="style" href="https://fonts.googleapis.com/css2?display=swap&amp;family=Manrope:wght@400;500;700;800"
        onload="this.rel='stylesheet'" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#17cf17",
                        "background-light": "#f6f8f6",
                        "background-dark": "#112111",
                    },
                    fontFamily: {
                        display: ["Manrope"],
                    },
                    borderRadius: {
                        DEFAULT: "0.25rem",
                        lg: "0.5rem",
                        xl: "0.75rem",
                        full: "9999px",
                    },
                },
            },
        };
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <title>DigiBin Dashboard</title>
</head>

<body class="bg-background-light dark:bg-background-dark font-display text-gray-800 dark:text-gray-200">
    <div class="flex min-h-screen">
        <aside class="flex w-64 flex-col bg-background-light dark:bg-background-dark p-4 shadow-lg">
            <div class="flex items-center gap-2 px-2 py-4">
                <svg class="h-8 w-8 text-primary" fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                    <path d="M44 4H30.6666V17.3334H17.3334V30.6666H4V44H44V4Z" fill="currentColor"></path>
                </svg>
                <h1 class="text-xl font-bold text-gray-900 dark:text-white">DigiBin</h1>
            </div>
            <nav class="mt-8 flex flex-1 flex-col gap-2">
                <a class="flex items-center gap-3 rounded-lg bg-primary/20 px-4 py-2.5 text-gray-900 dark:text-white"
                    href="#">
                    <span class="material-symbols-outlined">group</span>
                    <span class="font-medium">Staff Management</span>
                </a>
                <a class="flex items-center gap-3 rounded-lg px-4 py-2.5 hover:bg-primary/10 dark:hover:bg-primary/20"
                    href="#">
                    <span class="material-symbols-outlined">local_shipping</span>
                    <span class="font-medium">Vehicle Management</span>
                </a>
            </nav>
            <div class="mt-auto">
                <button
                    class="flex w-full items-center justify-center gap-2 rounded-lg bg-primary px-4 py-3 text-white font-bold transition-colors hover:bg-primary/90">
                    <span class="material-symbols-outlined">description</span>
                    <span>Generate Report</span>
                </button>
            </div>
        </aside>
        <main class="flex-1">
            <header class="flex items-center justify-between border-b border-gray-200 dark:border-gray-700 px-10 py-4">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Dashboard</h2>
                <div class="flex items-center gap-4">
                    <button class="relative rounded-full p-2 hover:bg-primary/10 dark:hover:bg-primary/20">
                        <span class="material-symbols-outlined text-gray-600 dark:text-gray-300">notifications</span>
                        <span
                            class="absolute top-1 right-1 h-2.5 w-2.5 rounded-full bg-blue-500 border-2 border-background-light dark:border-background-dark"></span>
                    </button>
                    <img alt="User avatar" class="h-10 w-10 rounded-full"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuAIVKJZjMFQMZau2nlSOvZkCkLnqJXzC_M9sTPezXXWcr1zDtp8CcfNP2SEKIr0njNb_GnPiP03GCq3klHX2wKaDHBDgGeviMTlp4cxL2xXym9GukTrOvnkk6vCHXE4ef19n7A31fwsY1GZJDJmADCAnn5xs-zBomydkQ78fD6XtoO3uMfzBL7n08qVMlh3VVg3VlRH4TUVhgk2AXsk6ewAwLSrWsYpcNalzrY4J4RVthmSaGtohgJYrsGw1MCAL4hNlurRuOIWS6Y" />
                </div>
            </header>
            <div class="p-6">
                <div class="mb-6 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    <div class="rounded-lg bg-white dark:bg-gray-800 p-4 shadow">
                        <p class="text-sm text-gray-500 dark:text-gray-400">Total Active Smart Trash Bins</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white">1,250</p>
                    </div>
                    <div class="rounded-lg bg-white dark:bg-gray-800 p-4 shadow">
                        <p class="text-sm text-gray-500 dark:text-gray-400">Active TPS</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white">85</p>
                    </div>
                    <div class="rounded-lg bg-white dark:bg-gray-800 p-4 shadow">
                        <p class="text-sm text-gray-500 dark:text-gray-400">Pending Complaints</p>
                        <p class="text-3xl font-bold text-blue-500">12</p>
                    </div>
                    <div class="rounded-lg bg-white dark:bg-gray-800 p-4 shadow">
                        <p class="text-sm text-gray-500 dark:text-gray-400">Avg. Daily Waste Volume</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white">1,200 kg</p>
                    </div>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="lg:col-span-2 rounded-lg bg-white dark:bg-gray-800 p-6 shadow">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Waste Volume Trend</h3>
                            <div class="flex items-center gap-1 text-sm">
                                <span class="text-gray-500 dark:text-gray-400">Last 30 Days</span>
                                <span class="font-medium text-green-500">+15%</span>
                            </div>
                        </div>
                        <div class="h-72">
                            <svg fill="none" height="100%" preserveAspectRatio="none" viewBox="0 0 472 150" width="100%"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M0 109C18.1538 109 18.1538 21 36.3077 21C54.4615 21 54.4615 41 72.6154 41C90.7692 41 90.7692 93 108.923 93C127.077 93 127.077 33 145.231 33C163.385 33 163.385 101 181.538 101C199.692 101 199.692 61 217.846 61C236 61 236 45 254.154 45C272.308 45 272.308 121 290.462 121C308.615 121 308.615 149 326.769 149C344.923 149 344.923 1 363.077 1C381.231 1 381.231 81 399.385 81C417.538 81 417.538 129 435.692 129C453.846 129 453.846 25 472 25V149H0V109Z"
                                    fill="url(#paint0_linear_chart)"></path>
                                <path
                                    d="M0 109C18.1538 109 18.1538 21 36.3077 21C54.4615 21 54.4615 41 72.6154 41C90.7692 41 90.7692 93 108.923 93C127.077 93 127.077 33 145.231 33C163.385 33 163.385 101 181.538 101C199.692 101 199.692 61 217.846 61C236 61 236 45 254.154 45C272.308 45 272.308 121 290.462 121C308.615 121 308.615 149 326.769 149C344.923 149 344.923 1 363.077 1C381.231 1 381.231 81 399.385 81C417.538 81 417.538 129 435.692 129C453.846 129 453.846 25 472 25"
                                    stroke="#17cf17" stroke-linecap="round" stroke-width="3"></path>
                                <defs>
                                    <linearGradient gradientUnits="userSpaceOnUse" id="paint0_linear_chart" x1="236"
                                        x2="236" y1="1" y2="149">
                                        <stop stop-color="#17cf17" stop-opacity="0.2"></stop>
                                        <stop offset="1" stop-color="#17cf17" stop-opacity="0"></stop>
                                    </linearGradient>
                                </defs>
                            </svg>
                        </div>
                    </div>
                    <div class="rounded-lg bg-white dark:bg-gray-800 p-6 shadow">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Notifications/Alerts</h3>
                        <ul class="space-y-4">
                            <li class="flex items-start gap-3">
                                <span class="material-symbols-outlined text-red-500 mt-0.5">error</span>
                                <div>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">Bin 004 is nearing full
                                        capacity.</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">2024-01-20 10:00</p>
                                </div>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="material-symbols-outlined text-yellow-500 mt-0.5">warning</span>
                                <div>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">TPS 102 requires
                                        maintenance.</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">2024-01-19 15:30</p>
                                </div>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="material-symbols-outlined text-blue-500 mt-0.5">info</span>
                                <div>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">Bin 002 at Main Street
                                        is inactive.</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">2024-01-18 08:45</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="mt-6 space-y-6">
                    <div class="rounded-lg bg-white dark:bg-gray-800 shadow overflow-hidden">
                        <h3
                            class="text-lg font-semibold text-gray-900 dark:text-white p-4 border-b border-gray-200 dark:border-gray-700">
                            Smart Bin Status</h3>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                                <thead
                                    class="bg-gray-50 dark:bg-gray-700 text-xs uppercase text-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th class="px-6 py-3" scope="col">Bin ID</th>
                                        <th class="px-6 py-3" scope="col">Location</th>
                                        <th class="px-6 py-3" scope="col">Status</th>
                                        <th class="px-6 py-3" scope="col">Capacity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border-b bg-white dark:border-gray-700 dark:bg-gray-800">
                                        <th class="whitespace-nowrap px-6 py-4 font-medium text-gray-900 dark:text-white"
                                            scope="row">Bin 001</th>
                                        <td class="px-6 py-4">Park Avenue</td>
                                        <td class="px-6 py-4"><span
                                                class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900 dark:text-green-300">Active</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-2">
                                                <div class="w-24 h-2 rounded bg-gray-200 dark:bg-gray-700">
                                                    <div class="h-2 rounded bg-primary" style="width: 80%;"></div>
                                                </div><span>80%</span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="border-b bg-white dark:border-gray-700 dark:bg-gray-800">
                                        <th class="whitespace-nowrap px-6 py-4 font-medium text-gray-900 dark:text-white"
                                            scope="row">Bin 002</th>
                                        <td class="px-6 py-4">Main Street</td>
                                        <td class="px-6 py-4"><span
                                                class="inline-flex items-center rounded-full bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800 dark:bg-red-900 dark:text-red-300">Inactive</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-2">
                                                <div class="w-24 h-2 rounded bg-gray-200 dark:bg-gray-700">
                                                    <div class="h-2 rounded bg-primary" style="width: 20%;"></div>
                                                </div><span>20%</span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="border-b bg-white dark:border-gray-700 dark:bg-gray-800">
                                        <th class="whitespace-nowrap px-6 py-4 font-medium text-gray-900 dark:text-white"
                                            scope="row">Bin 003</th>
                                        <td class="px-6 py-4">Central Park</td>
                                        <td class="px-6 py-4"><span
                                                class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900 dark:text-green-300">Active</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-2">
                                                <div class="w-24 h-2 rounded bg-gray-200 dark:bg-gray-700">
                                                    <div class="h-2 rounded bg-primary" style="width: 50%;"></div>
                                                </div><span>50%</span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="border-b bg-white dark:border-gray-700 dark:bg-gray-800">
                                        <th class="whitespace-nowrap px-6 py-4 font-medium text-gray-900 dark:text-white"
                                            scope="row">Bin 004</th>
                                        <td class="px-6 py-4">Library Square</td>
                                        <td class="px-6 py-4"><span
                                                class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900 dark:text-green-300">Active</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-2">
                                                <div class="w-24 h-2 rounded bg-gray-200 dark:bg-gray-700">
                                                    <div class="h-2 rounded bg-primary" style="width: 90%;"></div>
                                                </div><span>90%</span>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="rounded-lg bg-white dark:bg-gray-800 shadow overflow-hidden">
                        <h3
                            class="text-lg font-semibold text-gray-900 dark:text-white p-4 border-b border-gray-200 dark:border-gray-700">
                            TPS Condition</h3>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                                <thead
                                    class="bg-gray-50 dark:bg-gray-700 text-xs uppercase text-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th class="px-6 py-3" scope="col">TPS ID</th>
                                        <th class="px-6 py-3" scope="col">Location</th>
                                        <th class="px-6 py-3" scope="col">Status</th>
                                        <th class="px-6 py-3" scope="col">Last Maintenance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border-b bg-white dark:border-gray-700 dark:bg-gray-800">
                                        <th class="whitespace-nowrap px-6 py-4 font-medium text-gray-900 dark:text-white"
                                            scope="row">TPS 101</th>
                                        <td class="px-6 py-4">Park Avenue</td>
                                        <td class="px-6 py-4"><span
                                                class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900 dark:text-green-300">Operational</span>
                                        </td>
                                        <td class="px-6 py-4">2023-11-15</td>
                                    </tr>
                                    <tr class="border-b bg-white dark:border-gray-700 dark:bg-gray-800">
                                        <th class="whitespace-nowrap px-6 py-4 font-medium text-gray-900 dark:text-white"
                                            scope="row">TPS 102</th>
                                        <td class="px-6 py-4">Main Street</td>
                                        <td class="px-6 py-4"><span
                                                class="inline-flex items-center rounded-full bg-yellow-100 px-2.5 py-0.5 text-xs font-medium text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300">Needs
                                                Maintenance</span></td>
                                        <td class="px-6 py-4">2023-09-20</td>
                                    </tr>
                                    <tr class="border-b bg-white dark:border-gray-700 dark:bg-gray-800">
                                        <th class="whitespace-nowrap px-6 py-4 font-medium text-gray-900 dark:text-white"
                                            scope="row">TPS 103</th>
                                        <td class="px-6 py-4">Central Park</td>
                                        <td class="px-6 py-4"><span
                                                class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900 dark:text-green-300">Operational</span>
                                        </td>
                                        <td class="px-6 py-4">2023-12-05</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

</body>

</html>
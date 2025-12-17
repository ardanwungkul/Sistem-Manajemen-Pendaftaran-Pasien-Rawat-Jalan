<div class="block md:hidden">
    <button id="drawerToggleButton"
        class="text-white bg-bay-950 rounded-r-full px-1 py-2 md:hidden fixed flex items-center justify-center left-0 top-1/2 -translate-y-1/2"
        type="button" data-drawer-target="drawer-navigation" data-drawer-show="drawer-navigation"
        aria-controls="drawer-navigation">
        <i id="drawerIcon" class="fa-solid fa-arrow-right text-xs"></i>
    </button>
    <div id="drawer-navigation"
        class="fixed top-0 left-0 z-40 w-64 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-neutral-primary-soft border-e border-default"
        tabindex="-1" aria-labelledby="drawer-navigation-label">
        <div
            class="w-64 flex-none bg-gradient-to-b from-bay-950 to-bunting-950 h-screen p-3 fixed left-0 top-0 flex flex-col">
            <x-sidebar-item />
        </div>
    </div>
</div>
<div
    class="w-64 flex-none bg-gradient-to-b from-blue-950 to-blue-950 h-screen p-3 fixed left-0 top-0 md:flex md:flex-col hidden">
    <x-sidebar-item class="" />
</div>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const button = document.getElementById("drawerToggleButton");
        const icon = document.getElementById('drawerIcon');
        const drawer = document.getElementById("drawer-navigation");

        function updateIcon() {
            if (drawer.classList.contains("transform-none")) {
                icon.classList.remove("fa-arrow-right");
                icon.classList.add("fa-arrow-left");
            } else {
                icon.classList.remove("fa-arrow-left");
                icon.classList.add("fa-arrow-right");
            }
        }

        const observer = new MutationObserver(updateIcon);

        observer.observe(drawer, {
            attributes: true,
            attributeFilter: ["class"]
        });

        updateIcon();

    });
</script>

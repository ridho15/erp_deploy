<script src="{{ asset('/assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('/assets/js/scripts.bundle.js') }}"></script>
<script src="{{ asset('/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
<script src="{{ asset('/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script src="{{ asset('/assets/js/widgets.bundle.js') }}"></script>
<script src="{{ asset('/assets/js/custom/widgets.js') }}"></script>
<script src="{{ asset('/assets/js/custom/apps/chat/chat.js') }}"></script>
<script src="{{ asset('/assets/js/custom/utilities/modals/create-project/type.js') }}"></script>
<script src="{{ asset('/assets/js/custom/utilities/modals/create-project/budget.js') }}"></script>
<script src="{{ asset('/assets/js/custom/utilities/modals/create-project/settings.js') }}"></script>
<script src="{{ asset('/assets/js/custom/utilities/modals/create-project/team.js') }}"></script>
<script src="{{ asset('/assets/js/custom/utilities/modals/create-project/targets.js') }}"></script>
<script src="{{ asset('/assets/js/custom/utilities/modals/create-project/files.js') }}"></script>
<script src="{{ asset('/assets/js/custom/utilities/modals/create-project/complete.js') }}"></script>
<script src="{{ asset('/assets/js/custom/utilities/modals/create-project/main.js') }}"></script>
<script src="{{ asset('/assets/js/custom/utilities/modals/users-search.js') }}"></script>
<script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
<script src="{{ asset('/assets/js/alpine.min.js') }}"></script>
<script src="{{ asset('/assets/js/custom.js') }}"></script>
@yield('js')
@livewireScripts
@stack('js')

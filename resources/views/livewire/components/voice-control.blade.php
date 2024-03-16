<div>
</div>

@script
    <script>
        if (annyang) {
            var commands = {
                'go to *route': function(route) {

                    console.log('go to '+route);

                    var task_route_combinations = ['task', 'tasks', 'task list', 'task list view', 'task add', 'task create', 'task edit', 'task update', 'task delete', 'task view', 'task details', 'task information', 'task information view', 'task information details'];
                    var project_route_combinations = ['project', 'projects', 'project list', 'project list view', 'project add', 'project create', 'project edit', 'project update', 'project delete', 'project view', 'project details', 'project information', 'project information view', 'project information details'];
                    var client_route_combinations = ['client', 'clients', 'client list', 'client list view', 'client add', 'client create', 'client edit', 'client update', 'client delete', 'client view', 'client details', 'client information', 'client information view', 'client information details'];
                    var team_route_combinations = ['team', 'teams', 'team list', 'team list view', 'team add', 'team create', 'team edit', 'team update', 'team delete', 'team view', 'team details', 'team information', 'team information view', 'team information details'];
                    var user_route_combinations = ['user', 'users', 'user list', 'user list view', 'user add', 'user create', 'user edit', 'user update', 'user delete', 'user view', 'user details', 'user information', 'user information view', 'user information details'];
                    var dashboard_route_combinations = ['dashboard', 'home', 'main', 'main page', 'main page view', 'main page details', 'main page information', 'main page information view', 'main page information details'];

                    if (task_route_combinations.includes(route)) {
                        route = 'tasks';
                    } else if (project_route_combinations.includes(route)) {
                        route = 'projects';
                    } else if (client_route_combinations.includes(route)) {
                        route = 'clients';
                    } else if (team_route_combinations.includes(route)) {
                        route = 'teams';
                    } else if (user_route_combinations.includes(route)) {
                        route = 'users';
                    } else if (dashboard_route_combinations.includes(route)) {
                        route = 'dashboard';
                    }

                    var routes = {
                        dashboard: "{{ route('dashboard') }}",
                        users: "{{ route('user.index') }}",
                        teams: "{{ route('team.index') }}",
                        clients: "{{ route('client.index') }}",
                        projects: "{{ route('project.index') }}",
                        tasks: "{{ route('task.index') }}",
                    };
                    if (routes[route]) {
                        window.location.href = routes[route];
                    }
                },
                'create client *client': function(client) {
                    @this.createClient(client);
                },

            };
            annyang.setLanguage('en-IN');
            annyang.addCommands(commands);
            annyang.start();
        }

        document.addEventListener('command-success', event => {
            toastr.remove();
            toastr.success(event.detail);
            window.location.reload();
        })
    </script>
@endscript

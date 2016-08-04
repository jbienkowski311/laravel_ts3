<div class="panel-group" role="tablist">
    <div class="panel panel-primary">
        <div class="panel-heading" role="tab" id="dashboard_links_heading">
            <h4 class="panel-title">
                <a href="#dashboard_links" class="" role="button" data-toggle="collapse" aria-expanded="true" aria-controls="dashboard_links">
                    Dashboard
                </a>
            </h4>
        </div>
        <div class="panel-collapse collapse in" id="dashboard_links" role="tabpanel" aria-labelledby="dashboard_links_heading" aria-expanded="true">
            <ul class="list-group">
                <li class="list-group-item"><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="panel-group" role="tablist">
    <div class="panel panel-primary">
        <div class="panel-heading" role="tab" id="system_links_heading">
            <h4 class="panel-title">
                <a href="#system_links" class="collapsed" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="system_links">
                    System
                </a>
            </h4>
        </div>
        <div class="panel-collapse collapse" id="system_links" role="tabpanel" aria-labelledby="system_links_heading" aria-expanded="false">
            <ul class="list-group">
                <li class="list-group-item"><a href="{{ url('/admin/users') }}">Users</a></li>
                <li class="list-group-item"><a href="{{ url('/admin/roles') }}">Roles</a></li>
                <li class="list-group-item"><a href="{{ url('/admin/permissions') }}">Permissions</a></li>
            </ul>
        </div>
    </div>
</div>

<div class="panel-group" role="tablist">
    <div class="panel panel-primary">
        <div class="panel-heading" role="tab" id="ts3_link_heading">
            <h4 class="panel-title">
                <a href="#ts3_link" class="collapsed" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="ts3_link">
                    TeamSpeak3
                </a>
            </h4>
        </div>
        <div class="panel-collapse collapse" id="ts3_link" role="tabpanel" aria-labelledby="ts3_link_heading" aria-expanded="false">
            <ul class="list-group">
                <li class="list-group-item"><a href="#">Stats</a></li>
                <li class="list-group-item"><a href="#">Users</a></li>
                <li class="list-group-item"><a href="#">Channels</a></li>
                <li class="list-group-item"><a href="#">Admins</a></li>
                <li class="list-group-item"><a href="#">Settings</a></li>
            </ul>
        </div>
    </div>
</div>
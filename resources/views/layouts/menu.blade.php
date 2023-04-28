<li class="nav-item">
    <a href="{{ route('projects.index') }}"
       class="nav-link {{ Request::is('projects*') ? 'active' : '' }}">
        <p>Projects</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('tasks.index') }}"
       class="nav-link {{ Request::is('tasks*') ? 'active' : '' }}">
        <p>Tasks</p>
    </a>
</li>



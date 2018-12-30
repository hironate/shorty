<!--
Shorty a superfast URL Shortner with API
Built in Latest Laravel 5.7

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
-->

<!DOCTYPE html>
<html ng-app="shorty">
    <head>
        <title>Shorty @yield('title')</title>
        @yield('css')
    </head>
    <body>
        <div class='container'>
            @yield('content')
        </div>

        <script src="/js/jquery-1.11.3.min.js"></script>
        @yield('js')
    </body>
</html>

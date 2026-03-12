<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\Role;

class PilrekMenuSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Parent Menu: Modul Pilrek
        $pilrekParent = Menu::updateOrCreate(
            ['slug' => 'pilrek.management'],
            [
                'name' => 'Manajemen Pilrek',
                'icon' => 'ri-shield-user-line',
                'path' => '#',
                'order_no' => 10,
            ]
        );

        // 2. Sub Menu: Timeline
        $timelineMenu = Menu::updateOrCreate(
            ['slug' => 'admin.pilrek-timeline.index'],
            [
                'parent_id' => $pilrekParent->id,
                'name' => 'Timeline & Tahapan',
                'icon' => 'ri-calendar-todo-line',
                'path' => 'admin/pilrek-timeline',
                'order_no' => 1,
            ]
        );

        // 3. Sub Menu: Kandidat
        $candidateMenu = Menu::updateOrCreate(
            ['slug' => 'admin.pilrek-candidate.index'],
            [
                'parent_id' => $pilrekParent->id,
                'name' => 'Bakal Calon',
                'icon' => 'ri-group-line',
                'path' => 'admin/pilrek-candidate',
                'order_no' => 2,
            ]
        );

        // 4. Sub Menu: Pengumuman
        $announcementMenu = Menu::updateOrCreate(
            ['slug' => 'admin.pilrek-announcement.index'],
            [
                'parent_id' => $pilrekParent->id,
                'name' => 'Pengumuman & Berita',
                'icon' => 'ri-broadcast-line',
                'path' => 'admin/pilrek-announcement',
                'order_no' => 3,
            ]
        );

        // 5. Sub Menu: Dokumen
        $documentMenu = Menu::updateOrCreate(
            ['slug' => 'admin.pilrek-document.index'],
            [
                'parent_id' => $pilrekParent->id,
                'name' => 'Unduh Dokumen',
                'icon' => 'ri-folder-download-line',
                'path' => 'admin/pilrek-document',
                'order_no' => 4,
            ]
        );

        // Assign to Super Admin and Admin roles
        $roles = Role::whereIn('slug', ['super-admin', 'admin'])->get();
        foreach ($roles as $role) {
            $role->menus()->syncWithoutDetaching([
                $pilrekParent->id => ['can_create' => true, 'can_read' => true, 'can_update' => true, 'can_delete' => true],
                $timelineMenu->id => ['can_create' => true, 'can_read' => true, 'can_update' => true, 'can_delete' => true],
                $candidateMenu->id => ['can_create' => true, 'can_read' => true, 'can_update' => true, 'can_delete' => true],
                $announcementMenu->id => ['can_create' => true, 'can_read' => true, 'can_update' => true, 'can_delete' => true],
                $documentMenu->id => ['can_create' => true, 'can_read' => true, 'can_update' => true, 'can_delete' => true],
            ]);
        }
    }
}

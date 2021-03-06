<?php

namespace Tests\BrowserKit;

use Tests\BrowserKitTestCase;
use App\User;
use App\Course;
use App\Content;

class ContentTest extends BrowserKitTestCase
{
    public function test_student_cannot_create_contents()
    {
        $user = factory(User::class)->create();
        $course = factory(Course::class)->create();
        $course->users()->sync([$user->id]);

        $this->actingAs($user)
            ->get(route('content.create', $course->id))
            ->assertResponseStatus(403);
    }

    public function test_teacher_can_create_contents()
    {
        $user = factory(User::class, 'teacher')->create();
        $course = factory(Course::class)->create();
        $course->teachers()->sync([$user->id]);

        $this->actingAs($user)
            ->visit(route('content.create', $course->id))
            ->type('Nuevo contenido', 'title')
            ->type('Texto del contenido', 'body')
            ->press('Publicar contenido')
            ->see('El contenido se ha publicado.')
            ->see('Nuevo contenido')
            ->see('Texto del contenido');
    }

    public function test_teacher_can_edit_contents()
    {
        $user = factory(User::class, 'teacher')->create();
        $content = factory(Content::class)->create();
        $content->course->teachers()->sync([$user->id]);

        $this->actingAs($user)
            ->visit(route('content.edit', $content->id))
            ->see($content->title)
            ->see($content->body)
            ->type('Título editado', 'title')
            ->type('Contenido editado', 'body')
            ->press('Publicar contenido')
            ->see('Título editado')
            ->see('Contenido editado');
    }

    public function test_student_can_see_contents()
    {
        $user = factory(User::class)->create();
        $content = factory(Content::class)->create();
        $content->course->teachers()->sync([$user->id]);

        $this->actingAs($user)
            ->visit(route('content.show', $content->id))
            ->see($content->title)
            ->see(markdownToHtml($content->body));
    }
}

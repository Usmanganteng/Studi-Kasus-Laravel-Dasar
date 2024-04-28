<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodolistControllerTest extends TestCase
{
    public function testTodolist()
    {
        $this->withSession([
            "user" => "aldizar",
            "todolist" => [
                [
                    "id" => "1",
                    "todo" => "ilham"
                ],
                [
                    "id" => "2",
                    "todo" => "Lulu"
                ]
            ]
        ])->get('/todolist')
            ->assertSeeText("1")
            ->assertSeeText("ilham")
            ->assertSeeText("2")
            ->assertSeeText("Lulu");
    }

    public function testAddTodoFailed()
    {
        $this->withSession([
            "user" => "aldizar"
        ])->post("/todolist", [])
            ->assertSeeText("Todo is required");
    }

    public function testAddTodoSuccess()
    {
        $this->withSession([
            "user" => "aldizar"
        ])->post("/todolist", [
            "todo" => "ilham"
        ])->assertRedirect("/todolist");
    }

    public function testRemoveTodolist()
    {
        $this->withSession([
            "user" => "aldizar",
            "todolist" => [
                [
                    "id" => "1",
                    "todo" => "ilham"
                ],
                [
                    "id" => "2",
                    "todo" => "Lulu"
                ]
            ]
        ])->post("/todolist/1/delete")
            ->assertRedirect("/todolist");
    }


}
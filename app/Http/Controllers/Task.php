<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \GuzzleHttp\Client as HttpClient;

class Task extends Controller
{
    public function getTaskById($id)
    {
        $title = "Ошибка при обработке запроса";
        if (! is_numeric($id)) {
            $title = "Некоректный номер задачи";
            return response()->view('error.404', ['title' => $title]);
        }
        $client = new HttpClient();
        $response = $client->request('GET',
            'https://mospoly.bitrix24.ru/rest/1252/0d9myrfz4hf3rm6c/tasks.task.get.json?taskId=' . $id,
            [
                'timeout' => 2
            ]
        );
        $task = json_decode($response->getBody()->getContents())->result;
        if (! $task) {
            return response()->view('error.404', ['title' => $title]);
        }
        $task = $task->task;
        if (! $this->checkTaskGroup($task)) {
            return response()->view('error.404', ['title' => $title]);
        }
        try {
            $status = $this->getTaskStatus($task->status);
        } catch (\Exception $exception) {
            return response()->view('error.404', ['title' => $title]);
        }
        return view('task', ['task' => $task, 'status' => $status]);
    }

    /**
     * @throws \Exception
     */
    private function getTaskStatus(?int $status): ?string
    {
        switch ($status) {
            case -3:
            case -2:
            case -1:
            case 1:
            case 2:
            case 3:
            case 6:
                return "Ваше обращение находится на этапе обработки.";
            case 4:
            case 5:
                return "Ваше обращение обработано.";
            case 7:
                return "Ваше обращение отклонено. Отправьте новую заявку.";
            default:
                throw new \Exception();
        }
    }

    private function checkTaskGroup(\stdClass $task): bool
    {
        if ($task->groupId == 216) {
            return true;
        } else {
            return false;
        }
    }
}

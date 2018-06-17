<?php
/**
 * ApiController.php
 *
 * API Controller
 *
 * @category   Controller
 * @package    MyKanban
 * @author     Francisco Ugalde
 * @copyright  2018 www.franciscougalde.com
 * @license    http://www.php.net/license/3_0.txt  PHP License 3.0
 */

namespace App\Controller;

use App\Entity\Board;
use App\Entity\Task;
use App\Entity\User;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;

/**
 * Class ApiController
 *
 * @Route("/api")
 */
class ApiController extends FOSRestController
{
    // USER URI's

    /**
     * @Rest\Post("/login_check", name="user_login_check")
     *
     * @SWG\Response(
     *     response=200,
     *     description="User was logged in successfully"
     * )
     *
     * @SWG\Response(
     *     response=500,
     *     description="User was not logged in successfully"
     * )
     *
     * @SWG\Parameter(
     *     name="_username",
     *     in="body",
     *     type="string",
     *     description="The username",
     *     schema={
     *     }
     * )
     *
     * @SWG\Parameter(
     *     name="_password",
     *     in="body",
     *     type="string",
     *     description="The password",
     *     schema={}
     * )
     *
     * @SWG\Tag(name="User")
     */
    public function getLoginCheckAction() {}

    /**
     * @Rest\Post("/register", name="user_register")
     *
     * @SWG\Response(
     *     response=201,
     *     description="User was successfully registered"
     * )
     *
     * @SWG\Response(
     *     response=500,
     *     description="User was not successfully registered"
     * )
     *
     * @SWG\Parameter(
     *     name="_name",
     *     in="body",
     *     type="string",
     *     description="The username",
     *     schema={}
     * )
     *
     * @SWG\Parameter(
     *     name="_email",
     *     in="body",
     *     type="string",
     *     description="The username",
     *     schema={}
     * )
     *
     * @SWG\Parameter(
     *     name="_username",
     *     in="body",
     *     type="string",
     *     description="The username",
     *     schema={}
     * )
     *
     * @SWG\Parameter(
     *     name="_password",
     *     in="query",
     *     type="string",
     *     description="The password"
     * )
     *
     * @SWG\Tag(name="User")
     */
    public function registerAction(Request $request, UserPasswordEncoderInterface $encoder) {
        $serializer = $this->get('jms_serializer');
        $em = $this->getDoctrine()->getManager();

        $user = [];
        $message = "";

        try {
            $code = 200;
            $error = false;

            $name = $request->request->get('_name');
            $email = $request->request->get('_email');
            $username = $request->request->get('_username');
            $password = $request->request->get('_password');

            $user = new User();
            $user->setName($name);
            $user->setEmail($email);
            $user->setUsername($username);
            $user->setPlainPassword($password);
            $user->setPassword($encoder->encodePassword($user, $password));

            $em->persist($user);
            $em->flush();

        } catch (Exception $ex) {
            $code = 500;
            $error = true;
            $message = "An error has occurred trying to register the user - Error: {$ex->getMessage()}";
        }

        $response = [
            'code' => $code,
            'error' => $error,
            'data' => $code == 200 ? $user : $message,
        ];

        return new Response($serializer->serialize($response, "json"));
    }

    // BOARD URI's

    /**
     * @Rest\Get("/v1/board.{_format}", name="board_list_all", defaults={"_format":"json"})
     *
     * @SWG\Response(
     *     response=200,
     *     description="Gets all boards for current logged user."
     * )
     *
     * @SWG\Response(
     *     response=500,
     *     description="An error has occurred trying to get all user boards."
     * )
     *
     * @SWG\Parameter(
     *     name="id",
     *     in="query",
     *     type="string",
     *     description="The board ID"
     * )
     *
     *
     * @SWG\Tag(name="Board")
     */
    public function getAllBoardAction(Request $request) {
        $serializer = $this->get('jms_serializer');
        $em = $this->getDoctrine()->getManager();
        $boards = [];
        $message = "";

        try {
            $code = 200;
            $error = false;

            $userId = $this->getUser()->getId();
            $boards = $em->getRepository("App:Board")->findBy([
                "user" => $userId,
            ]);

            if (is_null($boards)) {
                $boards = [];
            }

        } catch (Exception $ex) {
            $code = 500;
            $error = true;
            $message = "An error has occurred trying to get all Boards - Error: {$ex->getMessage()}";
        }

        $response = [
            'code' => $code,
            'error' => $error,
            'data' => $code == 200 ? $boards : $message,
        ];

        return new Response($serializer->serialize($response, "json"));
    }

    /**
     * @Rest\Get("/v1/board/{id}.{_format}", name="board_list", defaults={"_format":"json"})
     *
     * @SWG\Response(
     *     response=200,
     *     description="Gets board info based on passed ID parameter."
     * )
     *
     * @SWG\Response(
     *     response=400,
     *     description="The board with the passed ID parameter was not found or doesn't exist."
     * )
     *
     * @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     type="string",
     *     description="The board ID"
     * )
     *
     *
     * @SWG\Tag(name="Board")
     */
    public function getBoardAction(Request $request, $id) {
        $serializer = $this->get('jms_serializer');
        $em = $this->getDoctrine()->getManager();
        $board = [];
        $message = "";

        try {
            $code = 200;
            $error = false;

            $board_id = $id;
            $board = $em->getRepository("App:Board")->find($board_id);

            if (is_null($board)) {
                $code = 500;
                $error = true;
                $message = "The board does not exist";
            }

        } catch (Exception $ex) {
            $code = 500;
            $error = true;
            $message = "An error has occurred trying to get the current Board - Error: {$ex->getMessage()}";
        }

        $response = [
            'code' => $code,
            'error' => $error,
            'data' => $code == 200 ? $board : $message,
        ];

        return new Response($serializer->serialize($response, "json"));
    }

    /**
     * @Rest\Post("/v1/board.{_format}", name="board_add", defaults={"_format":"json"})
     *
     * @SWG\Response(
     *     response=201,
     *     description="Board was added successfully"
     * )
     *
     * @SWG\Response(
     *     response=500,
     *     description="An error was occurred trying to add new board"
     * )
     *
     * @SWG\Parameter(
     *     name="name",
     *     in="body",
     *     type="string",
     *     description="The board name",
     *     schema={}
     * )
     *
     * @SWG\Tag(name="Board")
     */
    public function addBoardAction(Request $request) {
        $serializer = $this->get('jms_serializer');
        $em = $this->getDoctrine()->getManager();
        $board = [];
        $message = "";

        try {
           $code = 201;
           $error = false;
           $name = $request->request->get("name", null);
           $user = $this->getUser();

           if (!is_null($name)) {
               $board = new Board();
               $board->setName($name);
               $board->setUser($user);

               $em->persist($board);
               $em->flush();

           } else {
               $code = 500;
               $error = true;
               $message = "An error has occurred trying to add new board - Error: You must to provide a board name";
           }

        } catch (Exception $ex) {
            $code = 500;
            $error = true;
            $message = "An error has occurred trying to add new board - Error: {$ex->getMessage()}";
        }

        $response = [
            'code' => $code,
            'error' => $error,
            'data' => $code == 201 ? $board : $message,
        ];

        return new Response($serializer->serialize($response, "json"));
    }

    /**
     * @Rest\Put("/v1/board/{id}.{_format}", name="board_edit", defaults={"_format":"json"})
     *
     * @SWG\Response(
     *     response=200,
     *     description="The board was edited successfully."
     * )
     *
     * @SWG\Response(
     *     response=500,
     *     description="An error has occurred trying to edit the board."
     * )
     *
     * @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     type="string",
     *     description="The board ID"
     * )
     *
     * @SWG\Parameter(
     *     name="name",
     *     in="body",
     *     type="string",
     *     description="The board name",
     *     schema={}
     * )
     *
     *
     * @SWG\Tag(name="Board")
     */
    public function editBoardAction(Request $request, $id) {
        $serializer = $this->get('jms_serializer');
        $em = $this->getDoctrine()->getManager();
        $board = [];
        $message = "";

        try {
            $code = 200;
            $error = false;
            $name = $request->request->get("name", null);
            $board = $em->getRepository("App:Board")->find($id);

            if (!is_null($name) && !is_null($board)) {
                $board->setName($name);

                $em->persist($board);
                $em->flush();

            } else {
                $code = 500;
                $error = true;
                $message = "An error has occurred trying to add new board - Error: You must to provide a board name or the board id does not exist";
            }

        } catch (Exception $ex) {
            $code = 500;
            $error = true;
            $message = "An error has occurred trying to edit the current board - Error: {$ex->getMessage()}";
        }

        $response = [
            'code' => $code,
            'error' => $error,
            'data' => $code == 200 ? $board : $message,
        ];

        return new Response($serializer->serialize($response, "json"));
    }

    /**
     * @Rest\Delete("/v1/board/{id}.{_format}", name="board_remove", defaults={"_format":"json"})
     *
     * @SWG\Response(
     *     response=200,
     *     description="Board was successfully removed"
     * )
     *
     * @SWG\Response(
     *     response=400,
     *     description="An error was occurred trying to remove the board"
     * )
     *
     * @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     type="string",
     *     description="The board ID"
     * )
     *
     * @SWG\Tag(name="Board")
     */
    public function deleteBoardAction(Request $request, $id) {
        $serializer = $this->get('jms_serializer');
        $em = $this->getDoctrine()->getManager();

        try {
            $code = 200;
            $error = false;
            $board = $em->getRepository("App:Board")->find($id);

            if (!is_null($board)) {
                $em->remove($board);
                $em->flush();

                $message = "The board was removed successfully!";

            } else {
                $code = 500;
                $error = true;
                $message = "An error has occurred trying to remove the currrent board - Error: The board id does not exist";
            }

        } catch (Exception $ex) {
            $code = 500;
            $error = true;
            $message = "An error has occurred trying to remove the current board - Error: {$ex->getMessage()}";
        }

        $response = [
            'code' => $code,
            'error' => $error,
            'data' => $message,
        ];

        return new Response($serializer->serialize($response, "json"));
    }

    // TASK URI's

    /**
     * @Rest\Post("/v1/task.{_format}", name="task_add", defaults={"_format":"json"})
     *
     * @SWG\Response(
     *     response=201,
     *     description="Task was added successfully"
     * )
     *
     * @SWG\Response(
     *     response=500,
     *     description="An error was occurred trying to add new task"
     * )
     *
     * @SWG\Parameter(
     *     name="title",
     *     in="body",
     *     type="string",
     *     description="The task title",
     *     schema={}
     * )
     *
     * @SWG\Parameter(
     *     name="description",
     *     in="body",
     *     type="string",
     *     description="The task description",
     *     schema={}
     * )
     *
     * @SWG\Parameter(
     *     name="status",
     *     in="body",
     *     type="string",
     *     description="The task status. Allowed values: Backlog, Working, Done",
     *     schema={}
     * )
     *
     * @SWG\Parameter(
     *     name="priority",
     *     in="body",
     *     type="string",
     *     description="The task priority. Allowed values: High, Medium, Low",
     *     schema={}
     * )
     *
     * @SWG\Parameter(
     *     name="board_id",
     *     in="body",
     *     type="string",
     *     description="The board id of the new task",
     *     schema={}
     * )
     *
     * @SWG\Tag(name="Task")
     */
    public function addTaskAction(Request $request) {
        $serializer = $this->get('jms_serializer');
        $em = $this->getDoctrine()->getManager();
        $task = [];
        $message = "";

        try {
            $code = 201;
            $error = false;
            $title = $request->request->get("title", null);
            $description = $request->request->get("description", null);
            $status = $request->request->get("status", null);
            $priority = $request->request->get("priority", null);
            $boardId= $request->request->get("board_id", null);

            if (!is_null($title) && !is_null($description) && !is_null($status) && !is_null($priority) && !is_null($boardId)) {
                $task = new Task();
                $board = $em->getRepository("App:Board")->find($boardId);
                $task->setBoard($board);
                $task->setTitle($title);
                $task->setDescription($description);
                $task->setStatus($status);
                $task->setPriority($priority);

                $em->persist($task);
                $em->flush();

            } else {
                $code = 500;
                $error = true;
                $message = "An error has occurred trying to add new task - Error: You must to provide all the required fields";
            }

        } catch (Exception $ex) {
            $code = 500;
            $error = true;
            $message = "An error has occurred trying to add new task - Error: {$ex->getMessage()}";
        }

        $response = [
            'code' => $code,
            'error' => $error,
            'data' => $code == 201 ? $task : $message,
        ];

        return new Response($serializer->serialize($response, "json"));
    }

    /**
     * @Rest\Put("/v1/task/{id}.{_format}", name="task_edit", defaults={"_format":"json"})
     *
     * @SWG\Response(
     *     response=200,
     *     description="The task was edited successfully."
     * )
     *
     * @SWG\Response(
     *     response=500,
     *     description="An error has occurred trying to edit the task."
     * )
     *
     * @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     type="string",
     *     description="The task ID"
     * )
     *
     * @SWG\Parameter(
     *     name="title",
     *     in="body",
     *     type="string",
     *     description="The task title",
     *     schema={}
     * )
     *
     * @SWG\Parameter(
     *     name="description",
     *     in="body",
     *     type="string",
     *     description="The task description",
     *     schema={}
     * )
     *
     * @SWG\Parameter(
     *     name="status",
     *     in="body",
     *     type="string",
     *     description="The task status. Allowed values: Backlog, Working, Done",
     *     schema={}
     * )
     *
     * @SWG\Parameter(
     *     name="priority",
     *     in="body",
     *     type="string",
     *     description="The task priority. Allowed values: High, Medium, Low",
     *     schema={}
     * )
     *
     *
     * @SWG\Tag(name="Task")
     */
    public function editTaskAction(Request $request, $id) {
        $serializer = $this->get('jms_serializer');
        $em = $this->getDoctrine()->getManager();
        $task = [];
        $message = "";

        try {
            $code = 200;
            $error = false;
            $title = $request->request->get("title", null);
            $description = $request->request->get("description", null);
            $status = $request->request->get("status", null);
            $priority = $request->request->get("priority", null);
            $task = $em->getRepository("App:Task")->find($id);

            if (!is_null($task)) {
                if (!is_null($title)) {
                    $task->setTitle($title);
                }

                if (!is_null($description)) {
                    $task->setDescription($description);
                }

                if (!is_null($status)) {
                    $task->setStatus($status);
                }

                if (!is_null($priority)) {
                    $task->setPriority($priority);
                }

                $em->persist($task);
                $em->flush();

            } else {
                $code = 500;
                $error = true;
                $message = "An error has occurred trying to edit the current task - Error: The task id does not exist";
            }

        } catch (Exception $ex) {
            $code = 500;
            $error = true;
            $message = "An error has occurred trying to edit the current task - Error: {$ex->getMessage()}";
        }

        $response = [
            'code' => $code,
            'error' => $error,
            'data' => $code == 200 ? $task : $message,
        ];

        return new Response($serializer->serialize($response, "json"));
    }

    /**
     * @Rest\Delete("/v1/task/{id}.{_format}", name="task_remove", defaults={"_format":"json"})
     *
     * @SWG\Response(
     *     response=200,
     *     description="Task was successfully removed"
     * )
     *
     * @SWG\Response(
     *     response=400,
     *     description="An error was occurred trying to remove the task"
     * )
     *
     * @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     type="string",
     *     description="The board ID"
     * )
     *
     * @SWG\Tag(name="Task")
     */
    public function deleteTaskAction(Request $request, $id) {
        $serializer = $this->get('jms_serializer');
        $em = $this->getDoctrine()->getManager();

        try {
            $code = 200;
            $error = false;
            $task = $em->getRepository("App:Task")->find($id);

            if (!is_null($task)) {
                $em->remove($task);
                $em->flush();

                $message = "The task was removed successfully!";

            } else {
                $code = 500;
                $error = true;
                $message = "An error has occurred trying to remove the currrent task - Error: The task id does not exist";
            }

        } catch (Exception $ex) {
            $code = 500;
            $error = true;
            $message = "An error has occurred trying to remove the current task - Error: {$ex->getMessage()}";
        }

        $response = [
            'code' => $code,
            'error' => $error,
            'data' => $message,
        ];

        return new Response($serializer->serialize($response, "json"));
    }


    /**
     * @Route("/v1/", name="api")
     */
    public function api()
    {
        return new Response(sprintf('Logged in as %s', $this->getUser()->getUsername()));
    }

}
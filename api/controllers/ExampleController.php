<?php
class ExampleController
{
    public function get($id)
    {
        // Handle GET request
        if ($id) {
            // Retrieve a specific example by ID
            // Perform database queries or any necessary logic
            // Return the example as a JSON response
            echo json_encode(['id' => $id, 'name' => 'Example']);
        } else {
            // Retrieve all examples
            // Perform database queries or any necessary logic
            // Return the list of examples as a JSON response
            echo json_encode([
                ['id' => 1, 'name' => 'Example 1'],
                ['id' => 2, 'name' => 'Example 2']
            ]);
        }
    }

    public function post()
    {
        // Handle POST request
        // Extract data from the request body ($_POST or JSON payload)
        // Perform validation and database insertion
        // Return the created example as a JSON response
        echo json_encode(['id' => 3, 'name' => 'New Example']);
    }

    public function put($id)
    {
        // Handle PUT request
        // Update the example with the given ID
        // Extract data from the request body ($_POST or JSON payload)
        // Perform validation and update the database
        // Return the updated example as a JSON response
        echo json_encode(['id' => $id, 'name' => 'Updated Example']);
    }

    public function delete($id)
    {
        // Handle DELETE request
        // Delete the example with the given ID from the database
        // Return a JSON response with the success status
        echo json_encode(['status' => 'success', 'message' => 'Example deleted']);
    }
}
?>

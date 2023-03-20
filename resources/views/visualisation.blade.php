<div id="sigma-container"></div>

<script>
    const container = document.getElementById("sigma-container");

    const graph = new Graph();

    @foreach($general_records as $general_record)

         graph.addNode("id{{ $general_record->id }}", { size: 10, label: "{{$general_record->value}}" });

    @endforeach

    @php
        $used_edges = [];
    @endphp

    @foreach($general_records as $general_record)

        @foreach($general_record->children_records as $children_record)

            @if(!in_array("id".$general_record->id."_id".$children_record->id, $used_edges))

                graph.addEdge("id{{ $general_record->id }}", "id{{ $children_record->id }}");

                @php
                    $used_edges[] = "id".$general_record->id."_id".$children_record->id;
                @endphp

            @endif

        @endforeach

        @foreach($general_record->parent_records as $parent_record)

            @if(!in_array("id".$parent_record->id."_id".$general_record->id, $used_edges))

                graph.addEdge("id{{ $parent_record->id }}", "id{{ $general_record->id }}");

                @php
                    $used_edges[] = "id".$parent_record->id."_id".$general_record->id;
                @endphp

            @endif

        @endforeach

    @endforeach

    if (graph.order > 1) {
        graph.nodes().forEach((node, i) => {
          const angle = (i * 2 * Math.PI) / graph.order;
          graph.setNodeAttribute(node, "x", 100 * Math.cos(angle));
          graph.setNodeAttribute(node, "y", 100 * Math.sin(angle));
        });
    }

    // Create the spring layout and start it
    const layout = new ForceSupervisor(graph, { isNodeFixed: (_, attr) => attr.highlighted });
    layout.start();

    // Create the sigma
    const renderer = new Sigma.Sigma(graph, container);

    //
    // Drag'n'drop feature
    // ~~~~~~~~~~~~~~~~~~~
    //

    // State for drag'n'drop
    let draggedNode = null;
    let isDragging = false;

    // On mouse down on a node
    //  - we enable the drag mode
    //  - save in the dragged node in the state
    //  - highlight the node
    //  - disable the camera so its state is not updated
    renderer.on("downNode", (e) => {
      isDragging = true;
      draggedNode = e.node;
      console.log(draggedNode);
      graph.setNodeAttribute(draggedNode, "highlighted", true);
    });

    // On mouse move, if the drag mode is enabled, we change the position of the draggedNode
    renderer.getMouseCaptor().on("mousemovebody", (e) => {
      if (!isDragging || !draggedNode) return;

      // Get new position of node
      const pos = renderer.viewportToGraph(e);

      graph.setNodeAttribute(draggedNode, "x", pos.x);
      graph.setNodeAttribute(draggedNode, "y", pos.y);

      // Prevent sigma to move camera:
      e.preventSigmaDefault();
      e.original.preventDefault();
      e.original.stopPropagation();
    });

    // On mouse up, we reset the autoscale and the dragging mode
    renderer.getMouseCaptor().on("mouseup", () => {
      if (draggedNode) {
        graph.removeNodeAttribute(draggedNode, "highlighted");
      }
      isDragging = false;
      draggedNode = null;
    });

    // Disable the autoscale at the first down interaction
    renderer.getMouseCaptor().on("mousedown", () => {
      if (!renderer.getCustomBBox()) renderer.setCustomBBox(renderer.getBBox());
    });

    //
    // Create node (and edge) by click
    // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    //

    // When clicking on the stage, we add a new node and connect it to the closest node
    renderer.on("clickStage", (event) => {
      // Sigma (ie. graph) and screen (viewport) coordinates are not the same.
      // So we need to translate the screen x & y coordinates to the graph one by calling the sigma helper `viewportToGraph`
      const coordForGraph = renderer.viewportToGraph({ x: event.x, y: event.y });

      // We create a new node
      const node = {
        ...coordForGraph,
        size: 10,
        color: chroma.random().hex(),
      };

      // Searching the two closest nodes to auto-create an edge to it
      const closestNodes = graph
        .nodes()
        .map((nodeId) => {
          const attrs = graph.getNodeAttributes(nodeId);
          const distance = Math.pow(node.x - attrs.x, 2) + Math.pow(node.y - attrs.y, 2);
          return { nodeId, distance };
        })
        .sort((a, b) => a.distance - b.distance)
        .slice(0, 2);

      // We register the new node into graphology instance
      const id = v4();
      graph.addNode(id, node);

      // We create the edges
      closestNodes.forEach((e) => graph.addEdge(id, e.nodeId));
    });

</script>
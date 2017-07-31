class MedProjectsOrgChart extends OrgChart {

    _createNode(nodeData, level) {
        let that = this,
                opts = this.options;
        return new Promise(function (resolve, reject) {
            if (nodeData.children) {
                for (let child of nodeData.children) {
                    child.parentId = nodeData.id;
                }
            }

            // construct the content of node
            let nodeDiv = document.createElement('div');

            delete nodeData.children;
            nodeDiv.dataset.source = JSON.stringify(nodeData);
            if (nodeData[opts.nodeId]) {
                nodeDiv.id = nodeData[opts.nodeId];
            }
            let inEdit = that.chart.dataset.inEdit,
                    isHidden;

            if (inEdit) {
                isHidden = inEdit === 'addChildren' ? ' slide-up' : '';
            } else {
                isHidden = level >= opts.depth ? ' slide-up' : '';
            }
            nodeDiv.setAttribute('class', 'node ' + (nodeData.className || '') + isHidden);
            if (opts.draggable) {
                nodeDiv.setAttribute('draggable', true);
            }
            if (nodeData.parentId) {
                nodeDiv.setAttribute('data-parent', nodeData.parentId);
            }
            nodeDiv.innerHTML = `
            <div class="org-chart-node-title">${nodeData[opts.nodeTitle]}</div>
            ${opts.nodeContent ? `<div class="org-chart-node-content">${nodeData[opts.nodeContent]}</div>` : ''}`;
            // append 4 direction arrows or expand/collapse buttons
            let flags = nodeData.relationship || '';

            if (opts.verticalDepth && (level + 2) > opts.verticalDepth) {
                if ((level + 1) >= opts.verticalDepth && Number(flags.substr(2, 1))) {
                    let toggleBtn = document.createElement('i'),
                            icon = level + 1 >= opts.depth ? 'plus' : 'minus';

                    toggleBtn.setAttribute('class', 'toggleBtn fa fa-' + icon + '-square');
                    nodeDiv.appendChild(toggleBtn);
                }
            } else {
                if (Number(flags.substr(0, 1))) {
                    let topEdge = document.createElement('i');

                    topEdge.setAttribute('class', 'edge verticalEdge topEdge fa');
                    nodeDiv.appendChild(topEdge);
                }
                if (Number(flags.substr(1, 1))) {
                    let rightEdge = document.createElement('i'),
                            leftEdge = document.createElement('i');

                    rightEdge.setAttribute('class', 'edge horizontalEdge rightEdge fa');
                    nodeDiv.appendChild(rightEdge);
                    leftEdge.setAttribute('class', 'edge horizontalEdge leftEdge fa');
                    nodeDiv.appendChild(leftEdge);
                }
                if (Number(flags.substr(2, 1))) {
                    let bottomEdge = document.createElement('i'),
                            symbol = document.createElement('i'),
                            title = nodeDiv.querySelector(':scope > .org-chart-node-title');

                    bottomEdge.setAttribute('class', 'edge verticalEdge bottomEdge fa');
                    nodeDiv.appendChild(bottomEdge);
                    symbol.setAttribute('class', 'fa ' + opts.parentNodeSymbol + ' symbol');
                    title.insertBefore(symbol, title.children[0]);
                }
            }

            nodeDiv.addEventListener('mouseenter', that._hoverNode.bind(that));
            nodeDiv.addEventListener('mouseleave', that._hoverNode.bind(that));
            nodeDiv.addEventListener('click', that._dispatchClickEvent.bind(that));
            if (opts.draggable) {
                nodeDiv.addEventListener('dragstart', that._onDragStart.bind(that));
                nodeDiv.addEventListener('dragover', that._onDragOver.bind(that));
                nodeDiv.addEventListener('dragend', that._onDragEnd.bind(that));
                nodeDiv.addEventListener('drop', that._onDrop.bind(that));
            }
            // allow user to append dom modification after finishing node create of orgchart
            if (opts.createNode) {
                opts.createNode(nodeDiv, nodeData);
            }

            resolve(nodeDiv);
        });
    }

}

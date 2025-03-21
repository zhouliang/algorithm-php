<?php
/**
 * Created by PhpStorm.
 * User: 南丞
 * Date: 2018/4/2
 * Time: 15:03
 * Prim算法
 *    prim算法的思想：
 *       初始化时，v0加入到最小树，其他所有顶点作为未加入树的集合
 *       取矩阵中第一横，$lowcost[]，其实就是v0与其他顶点的距离，找出最小的，比如v4，v4加入到最小树，此时最小数有两个节点了v0和v4
 *       接下来，要找到其他未加入树顶点中与最小树顶点距离最近的那个点
 *       $lowcost[]这是v0的数据
 *       找到v4与其他顶点的距离数据，即矩阵的第5横 $tmp[]
 *       然后$rmp[]和$lowcost[]纵向对比大小，小的数据设置到$lowcost[]
 *       然后横向对比$lowcost[]数据，找到最小点X，这个X即为与最小树距离最近的那个点
 *       同理，依次将所有顶点加入到最小树
 */

class Prim
{
    protected $c = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I'];
    protected $lowcost;
    /**
     * @param array $graph
     * @param $n
     */
    public function prim_main(array $graph, $n)
    {
        $sum = 0;
        for ($i = 1; $i < $n; $i++) {
            $this->lowcost[$i] = $graph[0][$i];
            $mst[$i] = 0;
        }
        for ($i = 1; $i < $n; $i++) {
            $min = 65535;
            $minid = 0;
            for ($j = 1; $j < $n; $j++) {
                if ($this->lowcost[$j] < $min && $this->lowcost[$j] != 0) {
                    $min = $this->lowcost[$j];
                    $minid = $j;
                }
            }
            echo '<pre>'.PHP_EOL;
                print_r($this->c[$mst[$minid]] ."到" . $this->c[$minid] . " 权值：" . $min);
            echo '</pre>'.PHP_EOL;

            $sum += $min;
            $this->lowcost[$minid] = 0;

            for ($j = 1; $j < $n; $j++) {
                if ($graph[$minid][$j] < $this->lowcost[$j]) {
                    $this->lowcost[$j] = $graph[$minid][$j];
                    $mst[$j] = $minid;
                }
            }
        }
        print_r("sum:" . $sum.PHP_EOL);
    }

    protected function prim_main2($graph, $n)
    {
        // Initialize lowcost array and adjvex array
        //$lowcost = array_fill(0, $n, 0);
        $lowcost = $graph[0];
        $adjvex = array_fill(0, $n, 0);
        $sum = 0;
        
        // Initialize with first vertex (v0)
        // for ($i = 1; $i < $n; $i++) {
        //     $lowcost[$i] = $graph[0][$i];
        //     $adjvex[$i] = 0;
        // }
        print_r($lowcost);
        print_r($adjvex);
        
        // Print header for visualization
        echo "Minimum Spanning Tree Edges:\n";
        
        // Main Prim algorithm loop
        for ($i = 1; $i < $n; $i++) {
            $min = 65535; // Using 65535 as infinity
            $j = 0;
            $k = 0;
            
            // Find the vertex with minimum cost edge
            for ($j = 1; $j < $n; $j++) {
                if ($lowcost[$j] != 0 && $lowcost[$j] < $min) {
                    $min = $lowcost[$j];
                    $k = $j;
                }
            }
            
            // Print the selected edge
            echo "{$this->c[$adjvex[$k]]} - {$this->c[$k]}, Weight: $min\n";
            $sum += $min;
            
            // Update lowcost after adding vertex k to MST
            $lowcost[$k] = 0;
            
            // Update lowcost values considering the newly added vertex
            print_r($lowcost);
            for ($j = 1; $j < $n; $j++) {
                if ($lowcost[$j] != 0 && $graph[$k][$j] < $lowcost[$j]) {
                    $lowcost[$j] = $graph[$k][$j];
                    $adjvex[$j] = $k;
                }
            }
            print_r($lowcost);
            print_r($adjvex);
            $i == 2 && exit;
       
        }
        
        echo "Total minimum weight: $sum\n";
    }

    public function main()
    {
        $map = [
            [0, 10, 65535, 65535, 65535, 11, 65535, 65535, 65535],
            [10, 0, 18, 65535, 65535, 65535, 16, 65535, 12],
            [65535, 18, 0, 22, 65535, 65535, 65535, 65535, 8],
            [65535, 65535, 22, 0, 20, 65535, 65535, 16, 21],
            [65535, 65535, 65535, 20, 0, 26, 65535, 7, 65535],
            [11, 65535, 65535, 65535, 26, 0, 17, 65535, 65535],
            [65535, 16, 65535, 65535, 65535, 17, 0, 19, 65535],
            [65535, 65535, 65535, 16, 7, 65535, 19, 0, 65535],
            [65535, 12, 8, 21, 65535, 65535, 65535, 65535, 0]
        ];
        $this->prim_main($map, count($map));
        $this->prim_main2($map, count($map));
    }
}

$obj = new Prim();
$obj->main();
